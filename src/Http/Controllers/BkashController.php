<?php

namespace Polashmahmud\Bkash\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Polashmahmud\Bkash\Events\BkashPaymentFail;
use Polashmahmud\Bkash\Events\BkashPaymentSuccess;
use Polashmahmud\Bkash\Models\Bkash;
use Session;
use URL;
use Illuminate\Support\Str;

class BkashController extends Controller
{
    private $base_url;

    public function __construct()
    {
        $this->base_url = config('bkash.base_url');
    }

    public function authHeaders()
    {
        return array(
            'Content-Type:application/json',
            'Authorization:' . $this->grant(),
            'X-APP-Key:' . config('bkash.app_key'),
        );
    }

    public function curlWithBody($url, $header, $method, $body_data_json)
    {
        $curl = curl_init($this->base_url . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body_data_json);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function grant()
    {
        $header = array(
            'Content-Type:application/json',
            'username:' . config('bkash.username'),
            'password:' . config('bkash.password'),
        );
        $header_data_json = json_encode($header);

        $body_data = array('app_key' => config('bkash.app_key'), 'app_secret' => config('bkash.app_secret'));
        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/token/grant', $header, 'POST', $body_data_json);

        $token = json_decode($response)->id_token;

        return $token;
    }

    public function createPayment(Request $request)
    {
        $request->validate([
            'amount'    => 'required|numeric|min:1',
            'reference' => 'nullable|string',
            'invoice'   => 'nullable|string',
            'redirect'  => 'nullable|string',
            'parameter' => 'nullable|string',
        ]);

        $header = $this->authHeaders();

        $website_url = URL::to("/");

        $body_data = array(
            'mode'                  => '0011',
            'payerReference'        => $request->reference ?? ' ',
            'callbackURL'           => $website_url . '/bkash/payment/callback' . ($request->redirect ? '?redirect=' . $request->redirect : '') . $request->parameter ?? '',
            'amount'                => $request->amount,
            'currency'              => 'BDT',
            'intent'                => 'sale',
            'merchantInvoiceNumber' => $request->invoice ?? Str::random(10),
        );
        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/create', $header, 'POST', $body_data_json);

        if (config('bkash.use') == 'web') {
            return redirect((json_decode($response)->bkashURL));
        }

        return $response;
    }

    public function executePayment($paymentID)
    {

        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID
        );

        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/execute', $header, 'POST', $body_data_json);

        $res_array = json_decode($response, true);

        if (isset($res_array['trxID'])) {
            // your database insert operation
        }

        return $response;
    }

    public function queryPayment($paymentID)
    {

        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );

        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/status', $header, 'POST', $body_data_json);

        $res_array = json_decode($response, true);

        if (isset($res_array['trxID'])) {
            // your database insert operation
        }

        return $response;
    }

    public function callback(Request $request)
    {
        $allRequest = $request->all();

        if (isset($allRequest['status']) && $allRequest['status'] == 'failure') {
            event(new BkashPaymentFail('Payment Failed !!'));

            return view('bkash::fail')->with([
                'response' => 'Payment Failed !!',
                'redirect' => $request->redirect ?? '',
            ]);
        } else if (isset($allRequest['status']) && $allRequest['status'] == 'cancel') {
            event(new BkashPaymentFail('Payment Cancelled !!'));

            return view('bkash::fail')->with([
                'response' => 'Payment Cancelled !!',
                'redirect' => $request->redirect ?? '',
            ]);
        } else {

            $response = $this->executePayment($allRequest['paymentID']);

            $res_array = json_decode($response, true);

            if (array_key_exists("statusCode", $res_array) && $res_array['statusCode'] != '0000') {
                event(new BkashPaymentFail($res_array['statusMessage']));

                return view('bkash::fail')->with([
                    'response' => $res_array['statusMessage'],
                    'redirect' => $request->redirect ?? '',
                ]);
            }

            if (array_key_exists("message", $res_array)) {
                // if execute api failed to response
                sleep(1);
                $response = $this->queryPayment($allRequest['paymentID']);
                $res_array = json_decode($response, true);
                $this->createBkashPayment($res_array);

                event(new BkashPaymentSuccess($res_array, $request->query()));

                return view('bkash::success')->with([
                    'response' => $res_array['trxID'],
                    'redirect' => $request->redirect ?? '',
                ]);
            }

            $this->createBkashPayment($res_array);

            event(new BkashPaymentSuccess($res_array, $request->query()));

            return view('bkash::success')->with([
                'response' => $res_array,
                'redirect' => $request->redirect ?? '',
            ]);
        }
    }

    public function getRefund($id)
    {
        $bkash = Bkash::findOrFail($id);

        return view('bkash::refund', compact('bkash'));
    }

    public function refundPayment(Request $request)
    {
        $request->validate([
            'paymentID' => 'required|string',
            'amount'    => 'required|numeric|min:1',
            'trxID'     => 'required|string',
            'reason'    => 'required|string',
        ]);

        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $request->paymentID,
            'amount'    => $request->amount,
            'trxID'     => $request->trxID,
            'sku'       => 'sku',
            'reason'    => $request->reason,
        );

        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/refund', $header, 'POST', $body_data_json);

        $res_array = json_decode($response, true);

        if (isset($res_array['refundTrxID'])) {
            // your database insert operation
            $transaction = Bkash::where('paymentID', $request->paymentID)->first();
            $transaction->refundTrxID = $res_array['refundTrxID'];
            $transaction->refundTransactionStatus = $res_array['transactionStatus'];
            $transaction->refundAmount = $res_array['amount'];
            $transaction->refundCurrency = $res_array['currency'];
            $transaction->refundCharge = $res_array['charge'];
            $transaction->refundCompletedTime = $res_array['completedTime'];
            $transaction->refundStatusCode = $res_array['statusCode'];
            $transaction->refundStatusMessage = $res_array['statusMessage'];
            $transaction->save();

            $message = "Refund successful.bKash refund trx ID : " . $res_array['refundTrxID'];
        } else {
            return back()->with('message', 'Refund Failed !!');
        }

        return redirect()->route('bkash.show', $transaction->id)->with('message', $message);
    }

    private function createBkashPayment($request)
    {

        Bkash::updateOrCreate(
            [
                'paymentID' => $request['paymentID'],
            ],
            [
                'trxID'                 => $request['trxID'],
                'transactionStatus'     => $request['transactionStatus'],
                'amount'                => $request['amount'],
                'currency'              => $request['currency'],
                'intent'                => $request['intent'],
                'paymentExecuteTime'    => $request['paymentExecuteTime'],
                'merchantInvoiceNumber' => $request['merchantInvoiceNumber'],
                'payerReference'        => $request['payerReference'],
                'customerMsisdn'        => $request['customerMsisdn'],
                'statusCode'            => $request['statusCode'],
                'statusMessage'         => $request['statusMessage']
            ]
        );
    }
}
