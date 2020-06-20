@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('doctor.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">{{isset($schedule)?'Edit ':'Set '}} Booking Schedule</li>
      </ol>
     
       
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>{{isset($schedule)?'Edit ':'Set '}} Booking Schedule</h2>
        <a href="{{route('doctor.schedule')}}" class="pull-right btn btn-outline-primary"><i class="fa fa-plus text-primary" ></i> New</a>
			</div>
			<div class="row">		
				<div class="col-md-12">
					@include('partials.error')
					 <form method="POST" action="{{isset($schedule)?route('doctor.update-schedule',$schedule->id):route('doctor.create-schedule')}}">
					 	@csrf
					 	@if(isset($schedule))
					 	@method('PUT')
					 	@endif
          <div class="row">
            <div class="col-md-4 col-sm-4 ">
               <div class="form-group">
            
          <label>Choose Day</label>
          
          <select class="form-control" name="day" >
          
          <option 
          @if(isset($schedule))
          	@if($schedule->day=="Sunday")
          	{{'selected'}}
          	@endif 
          @endif
          >Sunday</option>
          <option
          	@if(isset($schedule))
          	@if($schedule->day=="Monday")
          	{{'selected'}}
          	@endif 
          @endif
          >Monday</option>
          <option
          @if(isset($schedule))
          	@if($schedule->day=="Tuesday")
          	{{'selected'}}
          	@endif 
          @endif
          >Tuesday</option>
          <option
          @if(isset($schedule))
          	@if($schedule->day=="Wednessday")
          	{{'selected'}}
          	@endif 
          @endif
          >Wednesday</option>
          <option
          @if(isset($schedule))
          	@if($schedule->day=="Thursday")
          	{{'selected'}}
          	@endif 
          @endif
          >Thursday</option>
          <option
          @if(isset($schedule))
          	@if($schedule->day=="Friday")
          	{{'selected'}}
          	@endif 
          @endif
          >Friday</option>
          <option
          @if(isset($schedule))
          	@if($schedule->day=="Saturday")
          	{{'selected'}}
          	@endif 
          @endif
          >Saturday</option>
          
          </select>
          </div>
            </div>
            <div class="col-md-3 col-sm-3">
            	<div class="form-group">
               <label>Start Booking time</label>
              <div class="form-group ">
            <input class="form-control time_input" value="{{isset($schedule)?$schedule->start_time:''}}" placeholder="Choose time" name="startTime" >
            
          </div>
      			</div>
            </div>
            <div class="col-md-3 col-sm-3">
            	<div class="form-group">
              <label>End Booking time</label>
              <div class="form-group ">
            
            
            <input class="form-control time_input" value="{{isset($schedule)?$schedule->end_time:''}}" name="endTime" required placeholder="Choose time" >
           
          </div>
      		</div>
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary" id="submit1" name="submit">Save</button>
        </form>   
        
				</div>
				
			</div>
			<!-- /row-->
			
      
			<!-- /row-->
		</div>
		<!-- /box_general-->
		
		
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Created Schedule</h2>
			</div>
			<div class="row">		
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Day</th>
								<th>Start time</th>
								<th>End time</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@forelse($schedules as $schedule)
							<tr>
								<td>{{$schedule->day}}</td>
								<td>{{date('h:i a',strtotime($schedule->start_time))}}</td>
								<td>{{date('h:i a',strtotime($schedule->end_time))}}</td>
								<td><a href="{{route('doctor.edit-schedule',$schedule->id)}}" class='btn btn-xs btn-primary'><span class="fa fa-pencil"></span></a></td>
							</tr>
							@empty
							<p>You have not added schedule</p>
							@endforelse
						</tbody>
					</table>
        
				</div>
				
			</div>
			<!-- /row-->
			
      
			<!-- /row-->
		</div>
		</div>
		<!-- /box_general-->


    <!-- /box_general-->
		<!-- /box_general-->
		
	  </div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    flatpickr('.time_input',{
  		enableTime:true,
  		enableSeconds:true,
  		noCalendar: true,
	});
</script>

@endsection