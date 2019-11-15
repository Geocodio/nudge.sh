<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke(Request $request) {
        $user = $request->user();

        return view('landing', ['user' => $user]);
    }
}
