<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class WelcomeController extends Controller
{
    public function show(Request $request)
    {

        return view('Guest.Welcome');
    }
}
