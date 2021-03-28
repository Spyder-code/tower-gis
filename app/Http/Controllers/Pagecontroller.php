<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Pemilik;
use App\Models\Tower;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class Pagecontroller extends Controller
{
    public function index()
    {

        $kecamatan = Kecamatan::all();
        $pemilik = Pemilik::all();
        $tower = Tower::all();
        $kecamatanCount = array();
        $kecamatanName = array();
        foreach ($kecamatan as $item ) {
            $a = Tower::where('kecamatan',$item->id)->count();
            array_push($kecamatanCount,$a);
            array_push($kecamatanName,$item->name);
        }
        return view('user.index', compact('kecamatan','pemilik','tower','kecamatanCount','kecamatanName'));
    }

    public function filter(Request $request)
    {
        if(!empty($request->kecamatan) && !empty($request->tahun)){
            $data = Tower
            ::join('pemilik', 'pemilik.id','=','towers.pemilik')
            ->select('towers.*','pemilik.name as pemilik')->whereIn('kecamatan',$request->kecamatan)->
            whereYear('towers.created_at',$request->tahun)->get();
        }
        else if(!empty($request->kecamatan) && empty($request->tahun)){
            $data = Tower::join('pemilik', 'pemilik.id','=','towers.pemilik')
            ->select('towers.*','pemilik.name as pemilik')->
            whereIn('kecamatan',$request->kecamatan)->get();
        }
        else if(empty($request->kecamatan) && !empty($request->tahun)){
            $data = Tower::join('pemilik', 'pemilik.id','=','towers.pemilik')
            ->select('towers.*','pemilik.name as pemilik')->
            whereYear('towers.created_at',$request->tahun)->get();
        }
        if(empty($request->kecamatan) && empty($request->pemilik) && empty($request->tahun)){
            $data = '';
        }
        return response($data);
    }
}
