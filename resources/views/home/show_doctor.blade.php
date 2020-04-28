@extends('layouts.main')

@section('content')
	<div id="breadcrumb">
			<div class="container">
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="{{url()->previous()}}">Back</a></li>
					<li>{{$user->fullname}}</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_60">
			<div class="row">
				<div class="col-xl-8 col-lg-8">
					<nav id="secondary_nav">
						<div class="container">
							<ul class="clearfix">
								<li><a href="#section_1" class="active">General info</a></li>
								<li><a href="#section_2">Reviews</a></li>
								<li><a href="#sidebar">Booking</a></li>
							</ul>
						</div>
					</nav>
					<div id="section_1">
						<div class="box_general_3">
							<div class="profile">
								<div class="row">
									<div class="col-lg-5 col-md-4">
									<figure>
									<img src="{{(!empty($user->image))? asset($user->image):'http://via.placeholder.com/565x565.jpg'}}" alt="{{$user->fullname}}" class="img-fluid"/>
									
										</figure>
									</div>
									<div class="col-lg-7 col-md-8">
										Category: 
										@if($user->type==2)
										<small>{{$user->specialization->name}}</small>
										@else
										<small>{{$user->freelancercategory->name}}</small>
										@endif
										<h1>{{$user->type==2?'Dr. ':'Pharm. '}} {{$user->fullname}}</h1>
										<span class="rating">
											<i class="icon_star voted"></i>
											<i class="icon_star voted"></i>
											<i class="icon_star voted"></i>
											<i class="icon_star voted"></i>
											<i class="icon_star"></i>
											<!--<small>(145)</small>
											 <a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="img/badges/badge_1.svg" width="15" height="15" alt=""></a> -->
										</span>
										<ul class="statistic">
											<li>0 Views</li>
											@if($user->type==2)
											<li>{{$user->doctorAppointments->count()}} Clients</li>
											@endif
										</ul>
										<ul class="contacts">
											<li>
												<h6>Address</h6>
												{{$user->address}} -
												<!-- <a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" target="_blank"> <strong>View on map</strong></a> -->
											</li>
											<li>
												<h6>Phone</h6> <a href="tel://{{$user->phone}}">{{$user->phone}}</a></li>
											</ul>
											<ul class="statistic">
												@if($user->type==2)
												{{$user->consulting_type->name}}
												@else
												{{$user->freelancercategory->name}}
												@endif
										</ul>
									</div>
								</div>
								
                
                
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox_5p25"></div>
            
            
            
							</div>
							
							<hr>
							<div class="indent_title_in">
								<i class="pe-7s-comment"></i>
								<h3>Languanges Spoken</h3>
								<p>Professional Languages Spoken</p>
							</div>
							<div class="wrapper_indent">
								<p>{{$user->languages}}</p>
								
							</div>
							<hr/>
							<!-- /profile -->
							<div class="indent_title_in">
								<i class="pe-7s-user"></i>
								<h3>Professional statement</h3>
								<p>Summary of professional career</p>
							</div>
							<div class="wrapper_indent">
								<p>{{!!$user->description!!}}</p>
								<!-- <h6>Specializations</h6>
								<div class="row">
									<div class="col-lg-6">
										<ul class="bullets">
											<li>Abdominal Radiology</li>
											<li>Addiction Psychiatry</li>
											<li>Adolescent Medicine</li>
											<li>Cardiothoracic Radiology </li>
										</ul>
									</div>
									<div class="col-lg-6">
										<ul class="bullets">
											<li>Abdominal Radiology</li>
											<li>Addiction Psychiatry</li>
											<li>Adolescent Medicine</li>
											<li>Cardiothoracic Radiology </li>
										</ul>
									</div>
								</div> -->
								<!-- /row-->
							</div>
							<!-- /wrapper indent -->

							<hr>

							<div class="indent_title_in">
								<i class="pe-7s-news-paper"></i>
								<h3>Education</h3>
								<p>Education Summary</p>
							</div>
							<div class="wrapper_indent">
								<p>{{$user->education}}</p>
								<!-- <h6>Curriculum</h6>
								<ul class="list_edu">
									<li><strong>New York Medical College</strong> - Doctor of Medicine</li>
									<li><strong>Montefiore Medical Center</strong> - Residency in Internal Medicine</li>
									<li><strong>New York Medical College</strong> - Master Internal Medicine</li>
								</ul> -->
							</div>
							<!--  End wrapper indent -->

						</div>
						<!-- /section_1 -->
					</div>
					<!-- /box_general -->

					<div id="section_2">
						<div class="box_general_3">
							<div class="reviews-container">
								<div class="row">
								<!--	<div class="col-lg-3">
										<div id="review_summary">
											<strong>4.7</strong>
											<div class="rating">
												<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
											</div>
											<small>Based on 4 reviews</small>
										</div>
									</div>
									<div class="col-lg-9">
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
										</div>
									
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
										</div>
										
								 	<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
										</div>
								
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
										</div>
									
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
										</div>
									
									</div>-->
									 <h4 class="d-inline-block">What Patients say.</4>
									<br> <br><br>
									
								</div>
								<!-- /row -->

							<!--	<hr>-->
								<!--review section-->
									<!-- End review-box -->
							</div>
							<!-- End review-container -->
						</div>
					</div>
					<!-- /section_2 -->
				</div>
				<!-- /col -->
				<aside class="col-xl-4 col-lg-4" id="sidebar">
					@guest
					@if($user->type==2)
					<a href="{{ route('login') }}?redirect={{request()->url()}}" class="btn_1 btn-info full-width">Login to book doctor</a>
					@else
					<a href="{{ route('login') }}?redirect={{request()->url()}}" class="btn_1 btn-info full-width">Login to chat</a>
					@endif
							@endguest
							@auth
					<div class="box_general_3 booking">
						@if($user->type==2)
						<form id="bookingForm" method="POST" action="{{route('patient.bookDoctor',$user->id)}}">
							@csrf

							<input type="hidden" value="{{$user->payableAmount($user->consulting_fee)}}" name="amount">
							<div class="title">
							<h3>Book Doctor</h3>
							 <small>Consulting Time: {{$user->consult_hour}}</small><br/>
							 <small>Consulting Fee: ₦ {{$user->payableAmount($user->consulting_fee)}}</small> 
							</div>
							<h6 class="text text-primary"> Consultation Type: {{$user->consulting_type->name}}</h6>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<input class="form-control" name="dateBook" required type="text" id="booking_date" data-lang="en" data-min-year="2017" data-max-year="2020" data-disabled-days="10/17/2017,11/18/2017">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<input class="form-control" name="timeBook" required type="text" id="time_input" value="9:00 am">
									</div>
								</div>
							</div>
							<ul class="treatments clearfix">
								<strong>Doctors Schedule</strong>
								<li>
									<div class="checkbox">
										
										@foreach($user->schedules as $schedule)
											<label for="visit{{$schedule->id}}" class="css-label">{{$schedule->day}} <strong>{{date('h:i a',strtotime($schedule->start_time))}} to {{date('h:i a',strtotime($schedule->end_time))}} </strong></label>
										@endforeach
									</div>
								</li>
								
							</ul>
							
							<hr/>
							
													
							<input type="{{$user->consult_type_id==1? 'text':'hidden'}}" placeholder="Enter your location" class="form-control" name="patient_location">
							
							<hr/>
							
							
							
							<button type="submit" id="submit1" class="btn_1 full-width">Book Now</button>
							
								
							
						</form>
						@else
						@if($user->last_active> date('Y-m-d H:i:s', strtotime('+20 minutes')))
									<a href="{{route('patient.chatRequest',$user->id)}}" class="btn_1">Chat now</a>
									@else
									<a style="border: 2px solid red;color: red;" class="btn">Freelancer is offline</a>
									@endif
						@endif
					</div>
					@endauth
					<!-- /box_general -->
				</aside>
				<!-- /asdide -->
			</div>
			<!-- /row -->
		</div>
@endsection


@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    flatpickr('#time_input',{
  		enableTime:true,
  		enableSeconds:false,
  		noCalendar: true,
	});
</script>
@endsection