<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Pemilik;
use App\Models\Tower;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class Pagecontroller extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::all();
        $pemilik = Pemilik::all();
        $tower = Tower::all();
        return view('user.index', compact('kecamatan','pemilik','tower'));
    }

    public function filter(Request $request)
    {
        $tahun = $request->tahun;
        $kecamatans = $request->kecamatan;
        $pemiliks = $request->pemilik;
        if(!empty($request->kecamatan) && !empty($request->pemilik) && !empty($request->tahun)){
            $data = Tower::all()
            ->whereIn('kecamatan',$request->kecamatan)
            ->whereIn('pemilik',$request->pemilik)
            ->where(function($q) use($tahun){
                foreach ($tahun as $item ) {
                    $q->whereYear('created_at',$item);
                }
            });
        }
        else if(!empty($request->kecamatan) && !empty($request->pemilik)){
            $data = Tower::all()
            ->whereIn('kecamatan',$request->kecamatan)
            ->whereIn('pemilik',$request->pemilik);
        }
        else if(!empty($request->kecamatan) && !empty($request->tahun)){
            $data = Tower::all()
            ->whereIn('kecamatan',$request->kecamatan)
            ->where(function($q) use($tahun){
                foreach ($tahun as $item ) {
                    $q->whereYear('created_at',$item);
                }
            });
        }
        else if(!empty($request->pemilik) && !empty($request->tahun)){
            $data = Tower::all()
            ->whereIn('pemilik',$request->pemilik)
            ->where(function($q) use($tahun){
                foreach ($tahun as $item ) {
                    $q->whereYear('created_at',$item);
                }
            });
        }
        else {
            $data = Tower::
            orWhere(function($q) use($pemiliks){
                foreach ($pemiliks as $item ) {
                    $q->where('pemilik',$item);
                }
            })
            ->orWhere(function($q) use($kecamatans){
                foreach ($kecamatans as $item ) {
                    $q->where('kecamatan',$item);
                }
            })
            ->orWhere(function($q) use($tahun){
                foreach ($tahun as $item ) {
                    $q->whereYear('created_at',$item);
                }
            })->get();
        }
        if(empty($request->kecamatan) && empty($request->pemilik) && empty($request->tahun)){
            $data = '';
        }

        return response($data);
    }
}
