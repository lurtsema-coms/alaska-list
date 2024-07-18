<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SpecialBoost extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'from_date',
        'to_date',
        'image_name',
        'file_path',
        'link',
        'created_by',
        'updated_by',
    ];

}
