<?php

namespace Polashmahmud\Bkash\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransactionTable extends Component
{
    public $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function render(): View
    {
        return view('bkash::components.transaction-table');
    }
}
