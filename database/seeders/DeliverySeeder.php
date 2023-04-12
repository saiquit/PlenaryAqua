<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $upazilas = array(
            array(
                'district_id' => '2', 'name_en' => 'Paikgasa', 'name_bn' => 'পাইকগাছা', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '2', 'name_en' => 'Fultola', 'name_bn' => 'ফুলতলা', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '2', 'name_en' => 'Digholia', 'name_bn' => 'দিঘলিয়া', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '2', 'name_en' => 'Rupsha', 'name_bn' => 'রূপসা', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '2', 'name_en' => 'Terokhada', 'name_bn' => 'তেরখাদা', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '2', 'name_en' => 'Dumuria', 'name_bn' => 'ডুমুরিয়া', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '2', 'name_en' => 'Botiaghata', 'name_bn' => 'বটিয়াঘাটা', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '2', 'name_en' => 'Dakop', 'name_bn' => 'দাকোপ', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '2', 'name_en' => 'Koyra', 'name_bn' => 'কয়রা', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),

            array(
                'district_id' => '1', 'name_en' => 'Savar', 'name_bn' => 'সাভার', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '1', 'name_en' => 'Dhamrai', 'name_bn' => 'ধামরাই', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '1', 'name_en' => 'Keraniganj', 'name_bn' => 'কেরাণীগঞ্জ', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '1', 'name_en' => 'Nawabganj', 'name_bn' => 'নবাবগঞ্জ', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
            array(
                'district_id' => '1', 'name_en' => 'Dohar', 'name_bn' => 'দোহার', 'cost' => rand(10, 100), 'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ),
        );

        foreach ($upazilas as $key => $upa) {
            DB::table('delivery')->insert($upa);
        }
    }
}
