@extends('layouts.dashboard')


@section('content')

    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('patient.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Pharmacies</li>
      </ol>
      <div class="alert alert-info">
        This shows the list of all labs around your city {{auth()->user()->city}}
      </div>
    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Lab List</h2>
        
      </div>
      <div class="list_general">
        <ul>
          @forelse($labs as $lab)
          <li style="padding-left: 37px">
            
            <h4>{{$lab->business_name}}</h4>
            <ul class="booking_details">
              <li><strong>Address</strong> {{$lab->address}}</li>
              <li><strong>City</strong> {{$lab->city}}</li>
              <li><strong>Email</strong> {{$lab->email}}</li>
              <li><a href="{{route('patient.payTest',["user"=>$lab->id,'book'=>$book->id])}}" class="btn_1 gray approve"><i class="fa fa-fw fa-credit-card"></i> Buy</a></li>
            </ul>
            
          </li>
          @empty
          <p class="text-danger">
            No labs around your location {{auth()->user()->city}}
          </p>
          @endforelse
        </ul>
      </div>
    </div>
    <!-- /box_general-->
    {{$labs->links()}}
    <!-- /pagination-->
    </div>
    <!-- /container-fluid-->
    </div>
  
@endsection