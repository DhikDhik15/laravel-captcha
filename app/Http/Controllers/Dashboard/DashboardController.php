<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // proses pemanggilan datanya disini
        // nanti contoh return view nya jadi return view('dashboard.index', $data) -> atau;
        // return view('dashboard.index', compact('data'));
        return view('dashboard.index');
    }
}
