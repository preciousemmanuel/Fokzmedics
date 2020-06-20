@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
    </ol>
    <div class="alert alert-info">Do you want to book a doctor? <a href="{{route('doctors')}}">Click</a></div>
    <div class="row">
    	<div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-envelope-open"></i>
              </div>
              <div class="mr-5"><h5>Important Notice!! <small>Please read...</small></h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="javascript.void()" data-target="#info" data-toggle="modal">
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
              <div class="mr-5"><h5>{{auth()->user()->drugTransactions->count()}}Chat Log</h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        
    </div>

</div>



 <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Important info</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="modal-body">
            {!! $setting->info !!}
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            
          </div>
       
        </div>
      </div>
    </div>
@endsection