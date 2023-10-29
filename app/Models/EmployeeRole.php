<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee_role';

    protected $primarykey = "id";
    protected $foreignkey = ["employee_id"];

    protected $fillable = [
        'employee_id',
        'designation',
        'department',
    ];

    public function employees()
    {
        return $this->belongsTo("App\Models\Employee", "employee_id");
    }
}
