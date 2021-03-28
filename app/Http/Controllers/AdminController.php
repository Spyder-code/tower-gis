<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Pemilik;
use App\Models\Tower;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $tower = Tower::all();
        $transaksi = Transaction::all();
        $kecamatan = Kecamatan::all();
        $pemilik = Pemilik::all();
        return view('admin.dashboard', compact('tower','transaksi','kecamatan','pemilik'));
    }

    public function mapFilter(Request $request)
    {
        return response($request->all);
    }

    public function profile()
    {
        $user = User::find(Auth::id());
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

    public function data()
    {
        $kecamatan = Kecamatan::all()->sortByDesc('created_at');
        $pemilik = Pemilik::all()->sortByDesc('created_at');
        $kecamatanCount = array();
        $pemilikCount = array();
        foreach ($kecamatan as $item ) {
            $a = Tower::where('kecamatan',$item->id)->count();
            array_push($kecamatanCount,$a);
        }
        foreach ($pemilik as $item ) {
            $a = Tower::where('pemilik',$item->id)->count();
            array_push($pemilikCount,$a);
        }
        return view('admin.data', compact('kecamatan','pemilik','kecamatanCount','pemilikCount'));
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
