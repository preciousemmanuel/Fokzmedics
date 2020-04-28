@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Booking</li>
    </ol>


    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-calendar"></i>Booking detail   
         
          </h2>
        <button class="btn btn-xs " id="toggle-btn" style="float:right;cursor: pointer;"><i class="fa fa-minus" style="color: #001111"></i></button>
        <div class="clearfix"></div>
      </div>
      <div class="row" id="toggle-div">
      
        
        <div class="col-md-6">
          
          <label>Conversations</label>
            <div class="well chat-cont" style="max-height: 270px;margin-bottom: 10px;overflow-y: auto;width: 100%;background-color: #f0f0f0;padding: 7px"> 
              <ul class="chat-ul" style="list-style-type: none;font-weight: bold;font-size: 1.0em">
                
              
              
           </ul>
            </div>
           
        </div>
        <div class="col-md-6 add_top_30">
          <i style="font-weight: bold;">Patients Profile:</i>
          <div class="row">

            <div class="col-md-12">

              <div class="form-group">
                <label>Name</label>
                <p>Dr. {{$book->patient->fullname}}</p>
              </div>
            </div>
           
          </div>
          <!-- /row-->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <p>{{$book->patient->email}}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Gender</label>
                <p>{{$book->patient->gender}}    
                </p>
              </div>
            </div>
          </div>

         

          <!-- /row-->
          <hr>
          <h4>Booking Details</h4>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Booking Date</label>
                 <p> {{$book->start_book_time}}
                </p>
              </div>
            </div>
            
          </div>
          
        
        </div>
      </div>
    </div>
   

</div>
@endsection