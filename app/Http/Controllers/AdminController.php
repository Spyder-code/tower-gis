<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function tower()
    {
        $data = Tower::all();
        return view('admin.tower',compact('data'));
    }

    public function user()
    {
        return view('admin.user');
    }

    public function opd()
    {
        return view('admin.opd');
    }

    public function transaction()
    {
        return view('admin.transaction');
    }
}
