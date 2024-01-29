<?php

namespace Polashmahmud\Bkash\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SummaryChart extends Component
{
    public $sums;
    public $dates;
    public $period;

    public function __construct($sums, $dates, $period)
    {
        $this->sums = $sums;
        $this->dates = $dates;
        $this->period = $period;
    }

    public function render(): View
    {
        return view('bkash::components.summary-chart');
    }
}
