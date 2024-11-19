<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdjudicationController extends Controller
{
    public function create(Request $request): View
    {
        return view('userSetting.create');
    }
}
