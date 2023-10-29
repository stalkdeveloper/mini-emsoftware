@extends('admin.include.main')
@section('title', 'Create Employee')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Employee</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#">Employee</a></li>
                        <li class="breadcrumb-item"><a href="#">Create An Employee</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create an Employee</h5>
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" id="employeeData">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="company">Company</label>
                                    <select class="form-control" id="company" name="company" value="{{old('company')}}" placeholder="Select a company" required>
                                        <option value="">Select a company</option>
                                        @if(isset($company))
                                            @foreach ($company as $item)    
                                                <option value="{{$item->id}}">{{$item->company_name}} | {{$item->email}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="floating-label" for="Name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Enter a name" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="floating-label" for="Email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Enter a email" required>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label class="floating-label" for="mobile_number">Mobile No.</label>
                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{old('mobile_number')}}" placeholder="Enter a mobile number" required>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label class="floating-label" for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation" value="{{old('designation')}}" placeholder="Enter a designation" required>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label class="floating-label" for="department">department</label>
                                    <input type="text" class="form-control" id="department" name="department" value="{{old('department')}}" placeholder="Enter a department" required>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label class="floating-label" for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" placeholder="Enter a address" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-lg-12">
                                <input type="submit" value="submit" class="btn  btn-primary btn-sm float-float" id="employeeDisable">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

</div>
@endsection
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('#employeeData').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('getStoreEmployee') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response.status === true) { 
                        toastr.success(response.message);
                        // $("#employeeDisable").prop("disabled", true); 
                    } else {
                        toastr.error(response.error);
                    }
                },
            });
        });
    });
</script>