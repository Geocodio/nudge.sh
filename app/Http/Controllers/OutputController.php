<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Nudge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OutputController extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $nudge = Nudge::where('slug', $slug)->firstOrFail();

        $output = $nudge->output
            ? Crypt::decryptString($nudge->output)
            : '< No output recorded >';

        return response($output, 200)
            ->header('Content-Type', 'text/plain');
    }
}
