<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'status',
        'name',
        'sub_category_id',
        'price',
        'qty',
        'location',
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


    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function category()
    {
        return $this->subCategory->belongsTo(Category::class, 'category_id');
    }

    public function productIssue(){
        return $this->hasMany(ProductIssue::class, 'product_id');
    }

    public function specialBoost()
    {
        return $this->hasMany(SpecialBoost::class);
    }
    

    public function getActiveSpecialBoostCountAttribute()
    {
        $today = now()->toDateTimeString();

        // Count for special boosts
        $specialBoostCount = $this->specialBoost()
            ->where('from_date', '<=', $today)
            ->where('to_date', '>=', $today)
            ->count();

        // Count for advertisements associated with this product
        $advertisementCount = Advertisement::where('product_id', $this->id)
            ->where('from_date', '<=', $today)
            ->where('to_date', '>=', $today)
            ->count();

        // Return the special boost count if available, otherwise return the advertisement count
        return $specialBoostCount > 0 ? $specialBoostCount : $advertisementCount;
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeBelongsToUser($query, $userId)
    {
        return $query->where('created_by', $userId)
            ->where('status', 'ACTIVE');
    }

    public function scopeNotBoostedProduct($query,$userId)
    {
        $today = now()->toDateTimeString();

        $boostedProductsIds = SpecialBoost::where('from_date', '<=', $today)
            ->where('to_Date', '>=',$today)
            ->pluck('product_id')
            ->toArray();

        return $query->where('created_by' , $userId)
            ->where('status', 'ACTIVE')
            ->whereNotIn('id',$boostedProductsIds);
    }
}
