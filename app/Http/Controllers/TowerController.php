<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Pemilik;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class TowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tower::all()->sortByDesc('created_at');
        return view('admin.tower.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        $pemilik = Pemilik::all();
        return view('admin.tower.create',compact('kecamatan','pemilik'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'pemilik' => 'required',
            'kecamatan' => 'required',
        ]);

        Tower::create($request->all());
        Alert::success('Towers Created', 'Success Message');
        return redirect()->route('tower.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function show(Tower $tower)
    {
        $towerDataKecamatan = DB::table('towers')->select('kecamatan')->groupBy('kecamatan')->get();
        $towerDataPemilik = DB::table('towers')->select('pemilik')->groupBy('pemilik')->get();
        $kecamatan = array();
        $pemilik = array();
        foreach ($towerDataKecamatan as $item ) {
            array_push($kecamatan,$item->kecamatan);
        }
        foreach ($towerDataPemilik as $item ) {
            array_push($pemilik,$item->pemilik);
        }
        return view('admin.tower.show',compact('tower','kecamatan','pemilik'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function edit(Tower $tower)
    {
        $kecamatan = Kecamatan::all();
        $pemilik = Pemilik::all();
        return view('admin.tower.edit',compact('tower','kecamatan','pemilik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tower $tower)
    {
        $request->validate([
            'alamat' => 'required',
            'pemilik' => 'required',
            'kecamatan' => 'required',
        ]);

        Tower::find($tower->id)->update($request->all());
        Alert::success('Towers Updated', 'Success Message');
        return redirect()->route('tower.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tower $tower)
    {
        Tower::destroy($tower->id);
        Alert::success('Towers Deleted', 'Success Message');
        return redirect()->route('tower.index');
    }
}
