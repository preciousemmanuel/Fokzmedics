@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Bookings</li>
    </ol>


    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Booking List</h2> 
        <div class="filter">
          <select onchange="if (this.value) window.location.href=this.value" name="orderby" class="selectbox">
            <option value="">Any status</option>
            <option value="{{route('patient.bookings')}}">All</option>
            <option value="{{route('patient.bookings')}}?status=1">Pending</option>
            <option value="{{route('patient.bookings')}}?status=2">Paid</option>
            <option value="{{route('patient.bookings')}}?status=3">Ongoing</option>
            <option value="{{route('patient.bookings')}}?status=4">Caancelled</option>
          </select>
        </div>
      </div>
      <div class="list_general">
       <table class="table table-bordered table-responsive">
      <thead>
        <tr>
          <th></th>
          <th>Doctor name</th>
          <th>Booking date</th>
          <th>Duration</th>
          <th>Consultation type</th>
          <th>Status</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($bookings as $booking)
        <tr>
          <td>
            <img src="{{!empty($booking->doctor->image)?asset( $booking->doctor->image):asset('img/user.png')}}" alt=" {{$booking->doctor->fullname}}" style="border-radius: 50%" width="30px" height="30px">
          </td>
          <td>Dr. {{$booking->doctor->fullname}}</td>
          <td>{{date('Y-M-d h:i a',strtotime($booking->start_book_time))}}</td>
          <td>{{$booking->hour}}</td>
          <td>{{$booking->consultType->name}}</td>
          <td>
            @if($booking->status==1)
            <span class="text-info">Pending</span>
            @elseif($booking->status==2)
            <span class="text-primary">Paid but not started</span>
            @elseif($booking->status==3)
            <span class="text-success">Ongoing</span>
            @elseif($booking->status==4)
            <span class="text-danger">Closed</span>
            @endif
          </td>
          <td>

          <a class="btn_1 gray">View</a>
          </td>
          <td>
            @if($booking->status==3)
            <a href="" class="">Close</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <br/>
    <br/>
      </div>
      
    </div>
   

</div>
@endsection