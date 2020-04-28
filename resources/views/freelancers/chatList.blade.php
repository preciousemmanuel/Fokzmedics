@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('freelancer.index')}}">Dashboard</a>
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
            <figure><img src="{{!empty($chat->patient->image)?asset($chat->patient->image):'http://via.placeholder.com/565x565.jpg'}}" alt=""></figure>
            
            <h4>{{$chat->patient->fullname}}</h4>
            
         
            <ul class="buttons">
              <li><a href="{{route('freelancer.showChat',$chat->id)}}" class="btn btn-outline-success">Chat now/View</a></li>
            </ul>
                  
            
           
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