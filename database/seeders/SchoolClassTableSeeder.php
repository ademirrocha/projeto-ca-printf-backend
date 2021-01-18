<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass\SchoolClass;

class SchoolClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if(!SchoolClass::where('name', 'Bacharel Em Sistemas de Informações - BSI 2016')->exists()){
            SchoolClass::create([
                'name' => 'Bacharel Em Sistemas de Informações - BSI 2016'
            ]);
        }

        if(!SchoolClass::where('name', 'Bacharel Em Sistemas de Informações - BSI 2017')->exists()){
            SchoolClass::create([
                'name' => 'Bacharel Em Sistemas de Informações - BSI 2017'
            ]);
        }

        if(!SchoolClass::where('name', 'Bacharel Em Sistemas de Informações - BSI 2018')->exists()){
            SchoolClass::create([
                'name' => 'Bacharel Em Sistemas de Informações - BSI 2018'
            ]);
        }

        if(!SchoolClass::where('name', 'Bacharel Em Sistemas de Informações - BSI 2019')->exists()){
            SchoolClass::create([
                'name' => 'Bacharel Em Sistemas de Informações - BSI 2019'
            ]);
        }
        
    }
}
