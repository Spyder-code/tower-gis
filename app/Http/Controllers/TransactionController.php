<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'uang' => 'required',
            'tahun' => 'required'
        ]);

        Transaction::create($request->all());
        Alert::success('Transaction Created', 'Success Message');
        return redirect()->route('transaksi.show',['transaksi'=>$request->tower_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Tower $transaksi)
    {
        $tower = $transaksi;
        $data = Transaction::all()->where('tower_id',$transaksi->id);
        return view('admin.transaksi.index', compact('data','tower'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Tower $transaksi)
    {
        $tower = $transaksi;
        return view('admin.transaksi.create',compact('tower'));
    }

    public function tulis(Transaction $transaksi)
    {
        $tower = Tower::find($transaksi->tower_id);
        return view('admin.transaksi.edit',compact('tower','transaksi'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaksi)
    {
        $request->validate([
            'uang' => 'required',
            'tahun' => 'required'
        ]);

        Transaction::find($transaksi->id)->update($request->all());
        Alert::success('Transaction Updated', 'Success Message');
        return redirect()->route('transaksi.show',['transaksi'=>$request->tower_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaksi)
    {
        Transaction::destroy($transaksi->id);
        Alert::success('Transaction Deleted', 'Success Message');
        return redirect()->route('transaksi.show',['transaksi'=>$transaksi->tower_id]);
    }
}
