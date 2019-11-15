<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Nudge;
use App\Http\Controllers\Controller;

class OutputController extends Controller
{
    public function __invoke(Request $request, string $slug) {
        $nudge = Nudge::where('slug', $slug)->firstOrFail();

        $output = $nudge->output
            ? Crypt::decryptString($nudge->output)
            : '< No output recorded >';

        return response($output, 200)
            ->header('Content-Type', 'text/plain');
    }
}
