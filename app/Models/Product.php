<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'status',
        'name',
        'sub_category_id',
        'price',
        'qty',
        'description',
        'additional_information',
        'file_name',
        'file_path',
        'images',
        'created_by',
        'updated_by',
        'approved_by',
        'approved_at',
    ];

    public function subCategory(){
        return $this->belongsTo(Subcategory::class, 'sub_category_id');
    }

    public function category()
    {
        return $this->subCategory->belongsTo(Category::class, 'category_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
