
@extends('admin.include.main')
@section('title', 'Employee Details')
@section('content')
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
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
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
                                <td>
                                    {{$data->name ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$data->email ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$data->mobile_number ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$data->companies->company_name ?? 'N/A'}}
                                </td>

                                <td>
                                    {{$data->employeeroles->department ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$data->employeeroles->designation ?? 'N/A'}}
                                </td>
                                <td>
                                    <a href="{{route('getEditEmployee', $data->id)}}" class="btn btn-success btn-sm" role="button" aria- pressed="true">Edit</a>
                                </td>
                            </tbody>
                        </table>
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

