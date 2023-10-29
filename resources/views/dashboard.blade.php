{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('admin.include.main')
@section('title', 'Dashboard')
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard Analytics</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- table card-1 start -->
        <div class="col-md-12 col-xl-4">
            <!-- widget primary card start -->
            <div class="card flat-card widget-primary-card">
                <div class="row-table">
                    <div class="col-sm-3 card-body">
                        User
                    </div>
                    <div class="col-sm-9">
                        <h4>{{$user}}</h4>
                    </div>
                </div>
            </div>
            <!-- widget primary card end -->
        </div>
        <!-- table card-1 end -->
        <!-- table card-2 start -->
        <div class="col-md-12 col-xl-4">
            <!-- widget-success-card start -->
            <div class="card flat-card widget-purple-card">
                <div class="row-table">
                    <div class="col-sm-4 card-body">
                        Company
                    </div>
                    <div class="col-sm-8">
                        <h4>{{$company}}</h4>
                    </div>
                </div>
            </div>
            <!-- widget-success-card end -->
        </div>
        <!-- table card-2 end -->
        <!-- Widget primary-success card start -->
        <div class="col-md-12 col-xl-4">
            <div class="card flat-card widget-primary-card">
                <div class="row-table">
                    <div class="col-sm-8 card-body">
                        Employee
                    </div>
                    <div class="col-sm-4">
                        <h4>{{$emp}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widget primary-success card end -->

        <!-- prject ,team member start -->
        <div class="col-xl-12 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Employee</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
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
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection