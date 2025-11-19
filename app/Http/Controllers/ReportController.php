<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function reports()
    {
        return view('reports.reports');
    }
}
