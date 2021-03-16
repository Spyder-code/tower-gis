<?php

namespace Database\Seeders;

use App\Models\Pemilik;
use Illuminate\Database\Seeder;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Telkomsel',
            'Indosat',
            'PT. TOWER BERSAMA/ TBG',
            'PT. SOLU SINDO KREASI PRATAMA/ TBG',
            'PT. SOLUSI MENARA INDONESIA/ TBG',
            'Protelindo',
            'Komet Infra Nusantara (KIN)',
            'IBS',
            'STP',
            'XL/ Axis',
            'Mitratel',
            'XL',
            'PT. PRIMA MEDIA SELARAS/ TBG',
            'Retower/Centratama Menara Indonesia',
            'PT. TELENET INTERNUSA/ TBG',
        ];
        for ($i = 0; $i < count($data); $i++) {
            $name[] = [
                'name' => $data[$i]
            ];
        }
        Pemilik::insert($name);
    }
}
