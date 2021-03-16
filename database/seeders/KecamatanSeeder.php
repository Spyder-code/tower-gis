<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Gedeg','Jetis','Kemlagi','Dawar Blandong','Sooko','Trowulan','Puri','Mojoanyar','Bangsal','Mojosari','Pungging','Ngoro','Dlanggu','Gondang','Jatirejo','Kutorejo','Pacet','Trawas'];
        for ($i = 0; $i < count($data); $i++) {
            $name[] = [
                'name' => $data[$i]
            ];
        }
        Kecamatan::insert($name);
    }
}
