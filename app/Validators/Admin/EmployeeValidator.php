<?php
namespace App\Validators\Admin;

use App\Validators\Validator;

class EmployeeValidator extends Validator
{
    /**
     * Rules for User registration
     *
     * @var array
     */

    public function __construct($validationFor = 'add')
    {
        $commonRules = [
            'company' =>'required',
            'name' => 'required',
            'email'=> 'required|email|unique:employee,email',
            'mobile_number' => 'required|numeric|unique:employee,mobile_number',
            'designation' => 'required',
            'department' => 'required',
            'address' => 'required',
        ];
    
        if ($validationFor === 'update') {
            $commonRules = [
                'company' =>'required',
                'name' => 'required',
                'email'=> 'required|email',
                'mobile_number' => 'required|numeric',
                'designation' => 'required',
                'department' => 'required',
                'address' => 'required',
            ];
        }
    
        $this->rules = $commonRules;
    }


} 