<?php header("Access-Control-Allow-Origin: *"); ?>
@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
    </ol>
    <div class="col-md-6 mb-3">
    <div class="d-flex justify-content-between">
      <div>
        <a href="{{route('doctors')}}" class="btn btn-raised btn_1" style="background-color: #009900;box-shadow: 2px 4px 3px gray">Consult doctor</a>
      </div>
      <div>
        <a href="{{route('allFreelancers')}}" class="btn_1" style="background-color: #009900;box-shadow: 2px 4px 3px gray">Chat with pharmacist</a>
      </div>
      <div>
        <button onclick="myFunction()" class="btn_1" style="background-color: #009900;box-shadow: 2px 4px 3px gray">Invite friends</button>
      </div>
    </div>
  </div>
    <div class="row">
    	<div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-envelope-open"></i>
              </div>
              <div class="mr-5"><h5>{{auth()->user()->drugPrescriptions->count()}} Drug Prescription</h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('patient.automatedDrugs')}}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-envelope-open"></i>
              </div>
              <div class="mr-5"><h5>{{auth()->user()->testPrescriptions->count()}} Test Prescription</h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('patient.automatedTest')}}">
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
                <i class="fa fa-fw fa-envelope-open"></i>
              </div>
              <div class="mr-5"><h5>{{auth()->user()->patientAppointments->count()}} Bookings</h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('patient.bookings')}}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
    </div>

</div>
@endsection