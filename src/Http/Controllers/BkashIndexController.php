<?php

namespace Polashmahmud\Bkash\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Polashmahmud\Bkash\Models\Bkash;

class BkashIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $transactions = Bkash::latest()
            ->paginate()
            ->withQueryString();

        $period = request('period', 30);

        $chartData = Bkash::selectRaw('DATE(created_at) as date, SUM(amount) as sum')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->where('created_at', '>=', now()->subDays($period))
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'sum' => $item->sum,
                ];
            });

        $dates = $chartData->pluck('date')->toArray();
        $sums = $chartData->pluck('sum')->toArray();

        return view('bkash::index', [
            'transactions' => $transactions,
            'dates' => $dates,
            'sums' => $sums,
            'total' => $transactions->sum('amount'),
            'totalTransactions' => $transactions->count(),
            'period' => $period,
            'page' => $request->query('page'),
        ]);
    }
}
