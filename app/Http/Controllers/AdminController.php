<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $tower = Tower::all();
        $transaksi = Transaction::all();
        $towerKecamatan = DB::table('towers')->select('kecamatan')->groupBy('kecamatan')->get();
        $towerPemilik = DB::table('towers')->select('pemilik')->groupBy('pemilik')->get();
        return view('admin.dashboard', compact('tower','transaksi','towerKecamatan','towerPemilik'));
    }

    public function mapFilter(Request $request)
    {
        return response($request->all);
    }

    public function profile()
    {
        $user = User::find(1);
        return view('admin.profile',compact('user'));
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
        $data = Transaction::all();
        return view('admin.transaction', compact('data'));
    }

    public function transactionCreate()
    {
        $data = Tower::all();
        return view('admin.transactionCreate', compact('data'));
    }
}
