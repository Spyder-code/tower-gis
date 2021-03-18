<?php

namespace App\Providers;

use App\Models\Tower;
use App\Models\Transaction;
use Illuminate\Support\ServiceProvider;

class UpdateStatusProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $year = date('Y');
        $year = intval($year);
        $data = Tower::all();
        foreach ($data as $item ) {
            $transaksi = Transaction::where('tower_id',$item->id)->where('tahun',$year)->get();
            if (count($transaksi)>0) {
                Tower::find($item->id)->update([
                    'status' => 'Lunas'
                ]);
            }else{
                Tower::find($item->id)->update([
                    'status' => 'Belum bayar'
                ]);
            }
        }
    }
}
