<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Grade extends Model
{

    protected $fillable = ['name', 'notes'];
    public $translatable = ['name'];
    protected $table = 'grades';

    use HasFactory;
    use HasTranslations;

    public function sections()
    {
        return $this->hasMany('App\Models\Section', 'gradeId');
    }

    public function classrooms()
{
    return $this->hasMany('App\Models\Classroom', 'gradeId');
}

}
