<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee';

    protected $primarykey = "id";
    protected $foreignkey = ["user_id", "company_id"];

    protected $fillable = [
        'user_id',
        'company_id',
        'name',
        'email',
        'mobile_number',
        'address'
    ];

    public function companies()
    {
        return $this->belongsTo("App\Models\Company", "company_id");
    }

    public function employeeroles()
    {
        return $this->hasOne("App\Models\EmployeeRole");
    }
}
