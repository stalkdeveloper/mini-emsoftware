<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'company';

    protected $primarykey = "id";
    protected $foreignkey = "user_id";

    protected $fillable = [
        'user_id',
        'company_name',
        'email',
    ];
}
