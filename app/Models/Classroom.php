<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{



    use HasTranslations;
    public $translatable = ['name'];

    protected $table = 'classrooms';
    public $timestamps = true;

    protected $fillable = ['name','gradeId'];
    public function Grades(){
        return $this->belongsTo('App\Models\Grade','gradeId');
    }
    use HasFactory;
}
