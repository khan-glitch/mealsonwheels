<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolunteerDashboardController extends Controller
{
    public function index()
    {
        return view('dashboards.volunteer');
    }
}
