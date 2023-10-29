<?php

namespace App\Services\Admin;

use App\Services\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\EmployeeRole;
use Auth;

class EmployeeService extends Service
{
    public function employeeAll(){
        try {
            $data = Employee::with(['companies', 'employeeroles'])->orderBy('id', 'desc')->paginate(10, ['*'], 'employee');
            return $data;
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }

    public function employeeStore($request){
        try {
            $data = new Employee;
            $data->user_id  = Auth::user()->id;
            $data->company_id  = $request['company'];
            $data->name = $request['name'];
            $data->email  = $request['email'];
            $data->mobile_number = $request['mobile_number'];
            $data->address = $request['address'];
    
            if($data->save()){
                $role = new EmployeeRole;
                $role->employee_id = $data->id;
                $role->designation = $request['designation'];
                $role->department = $request['department'];

                if ($role->save()) {
                    return true;
                }
            }
            return false;
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }

    public function employeeView($id){
        try {
            $data = Employee::with(['companies', 'employeeroles'])->where('id', $id)->first();
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function employeeUpdateEmail($email){
        try {
            $data = Employee::where('email', $email)->first();
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function employeeUpdateNumber($number){
        try {
            $data = Employee::where('mobile_number', $number)->first();
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function employeeUpdate($request, $email, $mobile_number){
        try {
            $data = [
                'user_id'  => Auth::user()->id,
                'company_id'  => $request['company'],
                'name' => $request['name'],
                'email'  => $email,
                'mobile_number' => $mobile_number,
                'address' => $request['address'],
            ]; 
            $update = Employee::where('id', $request['id'])->update($data);
    
            if($update){
                $roleUpdate = [
                    'designation' => $request['designation'],
                    'department' => $request['department'],
                ];
                
                $role = EmployeeRole::where('employee_id', $request['id'])->update($roleUpdate);
                if ($role) {
                    return true;
                }
            }
            return false;
        } catch (\Throwable $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }
    public function employeeDelete($request){
        try {
            $data = Employee::where('id', $request['id'])->first();
            if($data->delete()){
                return true;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}