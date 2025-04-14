<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->delete();

        $specializations = [
            ['en'=>'Arabic','ar'=>'لغة عربية'],
            ['en'=>'English','ar'=>'لغة انجليزية'],
            ['en'=>'Maths','ar'=>'رياضيات'],
            ['en'=>'Science','ar'=>'علوم'],
            ['en'=>'Social Studies','ar'=>'دراسات اجتماعية'],
            ['en'=>'Religion','ar'=>'تربية دينية'],
            ['en'=>'Computer','ar'=>'حاسب الي'],
            ['en'=>'Activities','ar'=>'انشطة']
        ];


        foreach($specializations as $s){
            Specialization::create(['name'=>$s]);
        }

    }
}
