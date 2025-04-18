<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{

    use HasTranslations;
    use HasFactory;
    public $translatable = ['name'];

     protected $guarded= [];


     public function genders(){
         return $this->belongsTo('App\Models\Gender','genderId');
     }

     public function specializations(){
        return $this->belongsTo('App\Models\Specialization','specializationId');
     }

     public function sections()
     {
         return $this->belongsToMany('App\Models\Section','teacher_section');
     }
}
