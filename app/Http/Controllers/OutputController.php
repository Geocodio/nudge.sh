<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nudge;
use App\Http\Controllers\Controller;

class OutputController extends Controller
{
    public function __invoke(Request $request, string $slug) {
        $nudge = Nudge::where('slug', $slug)->firstOrFail();

        return response($nudge->output, 200)
            ->header('Content-Type', 'text/plain');
    }
}
