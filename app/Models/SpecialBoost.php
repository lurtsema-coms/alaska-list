<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialBoost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'advertising_plan_id',
        'product_id',
        'from_date',
        'to_date',
        'file_name',
        'file_path',
        'created_by',
        'updated_by',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function advertisingPlan()
    {
        return $this->belongsTo(AdvertisingPlan::class, 'advertising_plan_id');
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
