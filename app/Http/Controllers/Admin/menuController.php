<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class menuController extends Controller
{
    public function index()
    {
        return view('admin.menu.index');
    }
}
