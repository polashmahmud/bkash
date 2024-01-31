<?php

namespace Polashmahmud\Bkash\Http\Controllers;

use App\Http\Controllers\Controller;
use Polashmahmud\Bkash\Models\Bkash;

class BkashShowController extends Controller
{
    public function __invoke($id)
    {
        $bkash = Bkash::findOrFail($id);

        return view('bkash::show', [
            'bkash' => $bkash,
        ]);
    }
}
