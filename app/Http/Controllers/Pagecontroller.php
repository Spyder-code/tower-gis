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
        if(!empty($request->kecamatan) && !empty($request->tahun)){
            $data = Tower
            ::join('pemilik', 'pemilik.id','=','towers.pemilik')
            ->select('towers.*','pemilik.name as pemilik')->whereIn('kecamatan',$request->kecamatan)
            ->where(function($q) use($tahun){
                foreach ($tahun as $item ) {
                    $q->whereYear('created_at',$item);
                }
            })->get();
        }
        else if(!empty($request->kecamatan) && empty($request->tahun)){
            $data = Tower::join('pemilik', 'pemilik.id','=','towers.pemilik')
            ->select('towers.*','pemilik.name as pemilik')->
            whereIn('kecamatan',$request->kecamatan)->get();
        }
        else if(empty($request->kecamatan) && !empty($request->tahun)){
            $data = Tower::join('pemilik', 'pemilik.id','=','towers.pemilik')
            ->select('towers.*','pemilik.name as pemilik')->
            where(function($q) use($tahun){
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
