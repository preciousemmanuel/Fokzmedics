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
      <div class="alert alert-success">
        @if(isset($all))
        This shows list of all pharmacy
        @else
        This shows the list of all pharmacy around your city {{auth()->user()->city}}
        @endif
      </div>
    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Pharmacy List</h2>
        @if(isset($all))
        <a href="{{route('patient.drugStore',$book->id)}}" class="pull-right btn btn-outline-success">Show in location</a>
        @else
        <a href="{{route('patient.allPharmacies',$book->id)}}" class="pull-right btn btn-outline-success">Show all</a>
        @endif
      </div>
      <div class="list_general">
        <ul>
          @forelse($pharmacies as $pharmacy)
          <li style="padding-left: 37px">
            
            <h4>{{$pharmacy->business_name}}</h4>
            <ul class="booking_details">
              <li><strong>Address</strong> {{$pharmacy->address}}</li>
              <li><strong>City</strong> {{$pharmacy->city}}</li>
              <li><strong>Email</strong> {{$pharmacy->email}}</li>
              <li><a href="{{route('patient.buyDrugs',["user"=>$pharmacy->id,'book'=>$book->id])}}" class="btn_1 gray approve"><i class="fa fa-fw fa-credit-card"></i> Buy</a></li>
            </ul>
            
          </li>
          @empty
          <p class="text-danger">
            No pharmacies around your location {{auth()->user()->city}}
          </p>
          @endforelse
        </ul>
      </div>
    </div>
    <!-- /box_general-->
    {{$pharmacies->links()}}
    <!-- /pagination-->
    </div>
    <!-- /container-fluid-->
    </div>
  
@endsection