<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\EmployeeService;
use App\Validators\Admin\EmployeeValidator;
use App\Models\Company;


class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->EmployeeService = $employeeService;
    }

    public function allEmployee(Request $request){
        try {
            $employee = $this->EmployeeService->employeeAll();
            return view('admin.employee.index')->with(compact('employee'));
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }

    public function createEmployee(Request $request){
        try {
            $company = Company::orderBy('id', 'desc')->get();
            return view('admin.employee.create')->with(compact('company'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function storeEmployee(Request $request){
        try {
            $input = $request->all();
            $employeeValidator = new EmployeeValidator('add');

            if (!$employeeValidator->with($input)->passes()) {
                return response()->json(['status'=>false,'error'=>$employeeValidator->getErrors()[0]]);
            }

            $store = $this->EmployeeService->employeeStore($input);
            if($store){
                return response()->json(['status'=>true,'message'=>'Successfully, Added Employee..!!']);
            }
                return response()->json(['status'=>false,'error'=>'Sorry, Unable to add..!!']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }

    public function viewEmployee($id){
        try {
            $currenturl = url()->full();
            $parts = parse_url($currenturl);

            if (isset($parts['path'])) {
                $pathSegments = explode('/', $parts['path']);
                $editEmployeeUrl = '';
                foreach ($pathSegments as $segment) {
                    if ($segment === "edit-employee") {
                        $editEmployeeUrl = $segment;
                        break;
                    }elseif($segment === "view-employee"){
                        $editEmployeeUrl = $segment;
                        break;
                    }
                }
            }

            if($editEmployeeUrl == 'edit-employee'){
                $company = Company::orderBy('id', 'desc')->get();
                $data = $this->EmployeeService->employeeView($id);
                return view('admin.employee.edit')->with(compact('data', 'company'));
            }else if($editEmployeeUrl == 'view-employee'){
                $data = $this->EmployeeService->employeeView($id);
                return view('admin.employee.show')->with(compact('data'));
            }else{
                return back();
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateEmployee(Request $request){
        try {
            $input = $request->all();
            $employeeValidator = new EmployeeValidator('update');

            if (!$employeeValidator->with($input)->passes()) {
                return response()->json(['status'=>false,'error'=>$employeeValidator->getErrors()[0]]);
            }

            $data = $this->EmployeeService->employeeView($request['id']);
            $emails; 
            if($data->email === $input['email']){
                $emails = $input['email'] ?? '';
            }elseif($data->email !== $input['email']){
                $emailData = $this->EmployeeService->employeeUpdateEmail($request['email']);

                if(isset($emailData)){
                    return response()->json(['status'=>false,'error'=>'Email already exists..!!']);
                }else{
                    $emails = $input['email'] ?? '';
                }
            }

            $mobile_numbers;
            if($data->mobile_number === $input['mobile_number']){
                $mobile_numbers = $input['mobile_number'] ?? '';
            }elseif($data->mobile_number !== $input['mobile_number']){
                $numberData = $this->EmployeeService->employeeUpdateNumber($request['mobile_number']);
                if(isset($numberData)){
                    return response()->json(['status'=>false,'error'=>'Mobile number already exists..!!']);
                }else{
                    $mobile_numbers = $input['mobile_number'] ?? '';
                }
            }

            $update = $this->EmployeeService->employeeUpdate($input, $emails, $mobile_numbers);

            if($update){
                return response()->json(['status'=>true,'message'=>'Successfully, Updated Employee..!!']);
            }
            return response()->json(['status'=>false,'error'=>'Sorry, Unable to update..!!']);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteEmployee(Request $request){
        try {
            \Log::info($request);
            $delete = $this->EmployeeService->employeeDelete($request);

            if($delete){
                return response()->json(['status'=>true,'message'=>'Successfully, Deleted Employee..!!']);
            }
                return response()->json(['status'=>false,'error'=>'Sorry, Unable to delete..!!']);
        }catch (\Exception $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }
}
