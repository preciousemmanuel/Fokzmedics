@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('patient.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Chat list</li>
    </ol>


    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Chat List</h2> 
        
      </div>
      <div class="list_general">
      <ul>
        @forelse($chats as $chat)
          <li>
            <figure><img src="{{!empty($chat->doctor->image)?asset($chat->doctor->image):'http://via.placeholder.com/565x565.jpg'}}" alt=""></figure>
            <small>{{$chat->doctor->freelancercategory->name}}</small>
            <h4>{{$chat->doctor->fullname}}</h4>
            
            @if($chat->doctor->last_active> date('Y-m-d H:i:s', strtotime('+20 minutes')))
            <ul class="buttons">
              <li><a href="{{route('patient.showBooking',$chat->id)}}" class="btn btn-outline-success">Chat now</a></li>
            </ul>
                  
            @else
             <ul class="buttons">
                 <li><a href="{{route('patient.showBooking',$chat->id)}}" class="btn btn-outline-danger">Offline</a></li>
               </ul>
            @endif
           
          </li>
        @empty
        <p class="text-danger">No chat list</p>
        @endforelse
      </ul>
      </div>
    
       
    <br/>

    <br/>
    </div>
   

</div>
@endsection