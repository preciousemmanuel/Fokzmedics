@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
    </ol>
    <div class="row">
    	<div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-envelope-open"></i>
              </div>
              <div class="mr-5"><h5>{{$totalBookings->count()}} Total Bookings</h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('doctor.bookings')}}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-money"></i>
              </div>
              <div class="mr-5"><h5>N{{$paid}} Amount Paid</h5></div>
            </div>
           
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-envelope-open"></i>
              </div>
              <div class="mr-5"><h5>N{{$pending}} Pending Amount</h5></div>
            </div>
           
          </div>
        </div>
    </div>

</div>
@endsection

