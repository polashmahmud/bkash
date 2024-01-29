<?php

namespace Polashmahmud\Bkash\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SummaryCard extends Component
{
    public $total;
    public $totalTransactions;
    public $period;

    public function __construct($total, $totalTransactions, $period)
    {
        $this->total = $total;
        $this->totalTransactions = $totalTransactions;
        $this->period = $period;
    }

    public function render(): View
    {
        return view('bkash::components.summary-card');
    }
}
