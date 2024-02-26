<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

       $data = [
          'content' => 'admin.dashboard.index'
       ];

        return view ('admin.layouts.wrapper', $data);
    }
}