<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactForm extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'email',
        'message',
        'ip_address',
        'user_agent',
        'created_at',
        'uploaded_at',
        'deleted_at',
    ];
}
