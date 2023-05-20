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
            array('district_id' => '2', 'name_en' => 'Gollamari', 'name_bn' => 'গল্লামারী', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Zero Point', 'name_bn' => 'জিরো পয়েন্ট', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'HoglaDanga', 'name_bn' => 'হোগলাডাঙ্গা', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Chachibunia', 'name_bn' => 'ছাচিবুনিয়া', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Nirala', 'name_bn' => 'নিরালা', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Moylapota', 'name_bn' => 'ময়লাপোতা', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Shibbari', 'name_bn' => 'শিববাড়ি', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'New Market', 'name_bn' => 'নিউ মার্কেট', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Sonadanga', 'name_bn' => 'সোনাডাঙ্গা', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Boyra Bazar', 'name_bn' => 'বয়রা বাজার', 'cost' => 30.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),

            array('district_id' => '2', 'name_en' => 'Royal Mor', 'name_bn' => 'রয়েল মোড়', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Dak Bangla', 'name_bn' => 'ডাক বাংলা', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Rupsa', 'name_bn' => 'রূপসা', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Tutpara', 'name_bn' => 'টুটপাড়া', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Jelkhana Ghat', 'name_bn' => 'জেলখানা ঘাট', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Circit House', 'name_bn' => 'সার্কিট হাউজ', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'South Center Road', 'name_bn' => 'সাউথ সেন্টার রোড', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Power House', 'name_bn' => 'পাওয়ার হাউজ', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Nij Khamar', 'name_bn' => 'নিজ খামার', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Notun Bazar', 'name_bn' => 'নতুন বাজার', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Boro Bazar', 'name_bn' => 'বড় বাজার', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Mojgunni', 'name_bn' => 'মজগুন্নি', 'cost' => 40.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),

            array('district_id' => '2', 'name_en' => 'Khalishpur', 'name_bn' => 'খালিশপুর', 'cost' => 60.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Notun Rasta', 'name_bn' => 'নতুন রাস্তা', 'cost' => 60.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Koiya Bazar', 'name_bn' => 'কৈয়া বাজার', 'cost' => 60.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),

            array('district_id' => '2', 'name_en' => 'Doulatpur', 'name_bn' => 'দোলতপুর', 'cost' => 70.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Rali Gate', 'name_bn' => 'রেলি গেইট', 'cost' => 70.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Mohesor Pasa', 'name_bn' => 'মহেশর পাশা', 'cost' => 70.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),

            array('district_id' => '2', 'name_en' => 'Fulbari Gate', 'name_bn' => 'ফুলবাড়ী গেট', 'cost' => 80.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),

            array('district_id' => '2', 'name_en' => 'Siromoni', 'name_bn' => 'শিরোমনি', 'cost' => 90.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),

            array('district_id' => '2', 'name_en' => 'Fultola', 'name_bn' => 'ফুলতলা', 'cost' => 130.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '2', 'name_en' => 'Dumuria', 'name_bn' => 'ডুমুরিয়া', 'cost' => 130.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),

            array('district_id' => '2', 'name_en' => 'Gilatola', 'name_bn' => 'গিলাতলা', 'cost' => 100.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('district_id' => '1', 'name_en' => 'Dhaka City', 'name_bn' => 'ঢাকা সিটি', 'cost' => 100.0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        );

        foreach ($upazilas as $key => $upa) {
            DB::table('delivery')->insert($upa);
        }
    }
}
