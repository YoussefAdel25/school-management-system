<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class myParent extends Model
{

    use HasTranslations;
    public $translatable = [
        'fatherName',
        'jobFather',
        'jobMother',
        'nameMother',
        'addressFather',
        'addressMother',
    ];
    protected $table ='my_parents';
    protected $guarded = [];
    use HasFactory;

    public function images(){
        return $this->morphMany('App\Models\Image','imageable');
    }
}
