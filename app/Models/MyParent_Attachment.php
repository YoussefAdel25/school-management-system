<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyParent_Attachment extends Model
{


    protected $fillable = ['file_name', 'myParent_id'];
    use HasFactory;
}
