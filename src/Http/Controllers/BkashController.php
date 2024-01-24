<?php

namespace Polashmahmud\Bkash\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use URL;
use Illuminate\Support\Str;

class BkashController extends Controller
{
    private $base_url;

    public function __construct()
    {
        $this->base_url = env('BKASH_BASE_URL');
    }

    public function authHeaders(){
        return array(
            'Content-Type:application/json',
            'Authorization:' .$this->grant(),
            'X-APP-Key:'.env('BKASH_APP_KEY')
        );
    }

    public function curlWithBody($url,$header,$method,$body_data_json){
        $curl = curl_init($this->base_url.$url);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $body_data_json);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION, 1);
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
            'username:'.env('BKASH_USER_NAME'),
            'password:'.env('BKASH_PASSWORD')
        );
        $header_data_json=json_encode($header);

        $body_data = array('app_key'=> env('BKASH_APP_KEY'), 'app_secret'=>env('BKASH_APP_SECRET'));
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/token/grant',$header,'POST',$body_data_json);

        $token = json_decode($response)->id_token;

        return $token;
    }

    public function payment(Request $request)
    {
        return view('Bkash.pay');
    }

    public function createPayment(Request $request)
    {
        if(!$request->amount || $request->amount < 1){
            return redirect()->route('url-pay');
        }

        $header =$this->authHeaders();

        $website_url = URL::to("/");

        $body_data = array(
            'mode' => '0011',
            'payerReference' => ' ',
            'callbackURL' => $website_url.'/bkash/callback',
            'amount' => $request->amount,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => "Inv".Str::random(8)
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/create',$header,'POST',$body_data_json);

        return $response;

//        return redirect((json_decode($response)->bkashURL));
    }

    public function executePayment($paymentID)
    {

        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID
        );

        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/execute',$header,'POST',$body_data_json);

        $res_array = json_decode($response,true);

        if(isset($res_array['trxID'])){
            // your database insert operation
        }

        return $response;
    }

    public function queryPayment($paymentID)
    {

        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );

        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/status',$header,'POST',$body_data_json);

        $res_array = json_decode($response,true);

        if(isset($res_array['trxID'])){
            // your database insert operation
        }

        return $response;
    }

    public function callback(Request $request)
    {
        $allRequest = $request->all();

        if(isset($allRequest['status']) && $allRequest['status'] == 'failure'){
            return view('Bkash.fail')->with([
                'response' => 'Payment Failed !!'
            ]);

        }else if(isset($allRequest['status']) && $allRequest['status'] == 'cancel'){
            return view('Bkash.fail')->with([
                'response' => 'Payment Cancelled !!'
            ]);

        }else{

            $response = $this->executePayment($allRequest['paymentID']);

            $res_array = json_decode($response,true);

            if(array_key_exists("statusCode",$res_array) && $res_array['statusCode'] != '0000'){
                return view('Bkash.fail')->with([
                    'response' => $res_array['statusMessage'],
                ]);
            }

            if(array_key_exists("message",$res_array)){
                // if execute api failed to response
                sleep(1);
                $response = $this->queryPayment($allRequest['paymentID']);
                $res_array = json_decode($response,true);
                return view('Bkash.success')->with([
                    'response' => $res_array['trxID']
                ]);
            }

            return view('Bkash.success')->with([
                'response' => $res_array['trxID']
            ]);

        }

    }

    public function getRefund(Request $request)
    {
        return view('Bkash.refund');
    }

    public function refundPayment(Request $request)
    {
        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $request->paymentID,
            'amount' => $request->amount,
            'trxID' => $request->trxID,
            'sku' => 'sku',
            'reason' => 'Quality issue'
        );

        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/refund',$header,'POST',$body_data_json);

        $res_array = json_decode($response,true);

        if(isset($res_array['refundTrxID'])){
            // your database insert operation
            $message = "Refund successful.bKash refund trx ID : ".$res_array['refundTrxID'];
        }else{
            $message = "Refund Failed !!";
        }

        return view('Bkash.refund')->with([
            'response' => $message,
        ]);
    }
}
