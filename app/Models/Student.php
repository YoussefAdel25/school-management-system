<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{

    use HasTranslations;

    protected $casts = [
        'name' => 'array',
    ];

    public $translatable = ['name'];
    protected $guarded = [];
    use HasFactory;


    public function gender(){
        return $this->belongsTo('App\Models\Gender','genderId');
    }

    public function grade(){
        return $this->belongsTo('App\Models\Grade','gradeId');

    }

    public function religion(){
        return $this->belongsTo('App\Models\Religion','religionId');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','classId');
    }

    public function section(){
        return $this->belongsTo('App\Models\Section','sectionId');
    }

    public function images(){
        return $this->morphMany('App\Models\Image','imageable');
    }
}
