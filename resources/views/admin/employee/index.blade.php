
@extends('admin.include.main')
@section('title', 'All Employee')
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
                        <li class="breadcrumb-item"><a href="{{route('getAllEmployee')}}">Employee</a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllEmployee')}}">All Employee</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ Hover-table ] start -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>Employee</h5>
                    <span class="d-block m-t-5">Here, your <code>employee</code> will be available</span>
                        <a href="{{route('getCreateEmployee')}}" class="btn  btn-outline-primary float-right">Create Employee</a>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Company name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($employee))
                                    @if(is_array($employee) || is_object($employee))
                                        @forelse ($employee->chunk(20) as $emp)
                                            @forelse ($emp as $count=>$item)
                                                <tr id="row-{{ $item->id }}">
                                                    <td>{{$count+1}}</td> 
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->mobile_number}}</td>
                                                    <td>{{$item->companies->company_name ?? 'N/A'}}</td>
                                                    <td>{{$item->employeeroles->department ?? 'N/A'}}</td>
                                                    <td>{{$item->employeeroles->designation ?? 'N/A'}}</td>

                                                    <td>
                                                        <a href="{{route('getViewEmployee', $item->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true">View</a>
                                                        <a href="{{route('getEditEmployee', $item->id)}}" class="btn btn-success btn-sm" role="button" aria- pressed="true">Edit</a>
                                                        <button class="delete-button btn btn-danger btn-sm" data-id="{{ $item->id }}" type="button" onclick="deleteEmployee({{ $item->id }})">Delete</button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>
                                                        No Data Found!
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @empty
                                            <tr>
                                                <td>
                                                    No Data Found!
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif
                                @endif
                            </tbody>
                        </table>
                        {{$employee->appends(['filter'=>'employee', $employee->currentPage()])->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Hover-table ] end -->
        <!-- [ Background-Utilities ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function deleteEmployee(id) {
        var data = { id: id };
        $.ajax({
            url: "{{ route('getDeleteEmployee') }}",
            type: 'GET',
            data: data,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            success: function(response) {
                console.log(response);
                if (response.status === true) { 
                    toastr.success(response.message);
                    $('#row-' + id).remove();
                } else {
                    toastr.error(response.error);
                }
            },
        });
    }
</script>
