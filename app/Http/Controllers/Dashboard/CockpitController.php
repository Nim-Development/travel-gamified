<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CockpitController extends Controller
{
    public function sales()
    {
        return view('dashboard.cockpit.sales');
    }
}
