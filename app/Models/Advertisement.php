<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'advertising_plan_id',
        'uuid',
        'from_date',
        'to_date',
        'file_name',
        'file_path',
        'product_id',
        'created_by',
        'updated_by',
    ];

    public function advertisingPlan()
    {
        return $this->belongsTo(AdvertisingPlan::class, 'advertising_plan_id');
    }

    public function boostedProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
