<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;



class Section extends Model
{


    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable=['name','status','gradeId','classId'];

    protected $table = 'sections';
    public $timestamps = true;
    use HasFactory;


    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','classId');
    }

    public function grades(){
        return $this->belongsTo('App\Models\Grade','gradeId');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','teacher_section');
    }
}
