@extends('layouts.main')

@section('title')
<title>List of {{isset($category)?$category->name:''}} freelance pharmacist</title>
@endsection

@section('content')
	 <div id="results">
       <div class="container">
           <div class="row">
               <div class="col-md-6">
               	@if(isset($category))
                   <h4><strong>{{$category->freelancers->count()}}</strong>  results for {{$category->name}} freelance pharmacist</h4>
                   @else
                    <h4><strong>{{$freelancers->count()}}</strong>  results for freelance pharmacist</h4>
                   @endif
               </div>
               {{-- <div class="col-md-6">
                    <div class="search_bar_list">
                    <input type="text" class="form-control" placeholder="Ex. name of freelancer...">
                    
                </div>
               </div> --}}
           </div>
           <!-- /row -->
       </div>
       <!-- /container -->
   </div>
   <!-- /results -->

    <div class="filters_listing">
		<div class="container">
			<ul class="clearfix">
				<li>
					<h6>Categories</h6>
					<select onchange="if (this.value) window.location.href=this.value">
						<option value="">Search by category</option>
						<option value="{{route('allFreelancers')}}">All</option>
						@foreach($categories as $category)
						<option value="{{route('listFreelancers',$category->id)}}">{{$category->name}}</option>
						@endforeach
					</select>
				</li>
				{{-- <li>
					<h6>Layout</h6>
					<div class="layout_view">
						<a href="#0" class="active"><i class="icon-th"></i></a>
						<a href="list.html"><i class="icon-th-list"></i></a>
						<a href="list-map.html"><i class="icon-map-1"></i></a>
					</div>
				</li>
				<li>
					<h6>Sort by</h6>
					<select name="orderby" class="selectbox">
					<option value="Closest">Closest</option>
					<option value="Best rated">Best rated</option>
					<option value="Men">Men</option>
					<option value="Women">Women</option>
					</select>
				</li> --}}
			</ul>
		</div>
		<!-- /container -->
	</div>
	<!-- /filters -->

		<div class="container margin_60_35">
			<div class="row">
				<div class="col-xl-12 col-lg-12">
					@if(!Auth::check())
					<div class="alert alert-info"><a class="btn btn-outline-primary" href="{{ route('login') }}?redirect={{request()->url()}}">Login</a> to see online and offline freelance pharmacist</div>
					@else
					<div class="alert alert-info">Please refresh every 5minutes to see new online freelance pharmacist</div>
					@endif


				<div class="row">
					@forelse($freelancers->sortByDesc('last_active') as $freelancer)
				<div class="col-md-4">
						<div class="box_list wow fadeIn">
							<a href="{{route('viewPractitioner',$freelancer->id)}}" class="wish_bt"></a>
							<figure>

								<a href="{{route('viewPractitioner',$freelancer->id)}}" >
								<img src="{{!empty($freelancer->image)?asset($freelancer->image):'http://via.placeholder.com/565x565.jpg'}}" class="img-fluid" alt="{{$freelancer->fullname}}">
									<div class="preview"><span>Read more</span></div>
							</a>
							</figure>
							<div class="wrapper">
								<small>{{$freelancer->freelancercategory->name}}</small>
								<h3>{{$freelancer->fullname}}</h3>

								<p>{{$freelancer->description}}</p>
								<span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></span>
								<a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="img/badges/badge_1.svg" width="15" height="15" alt=""></a>
							</div>
							<ul>
								<li><a href="#0" onclick="onHtmlClick('Doctors', 0)"><i class="icon_pin_alt"></i>{{$freelancer->city}}</a></li>
								<li><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" target="_blank"><i class="icon_pin_alt"></i>Directions</a></li>
								<li>
									@if(Auth::check())
									@if($freelancer->last_active> date('Y-m-d H:i:s', strtotime('+20 minutes')))
									<a href="{{route('patient.chatRequest',$freelancer->id)}}">Chat now</a>
									@else
									<a style="border: 2px solid red;color: red;">Offline</a>
									@endif
									@else
									<small>Login to see online status</small>
									@endif
								</li>
							</ul>
						</div>
					</div>
					@empty
					<p class="text-danger">No freelance pharmacists</p>
					@endforelse
            	</div>
            
				</div>
							
							
				<!-- /asdide -->
			</div>
			<!-- /row -->
		</div>
@endsection


@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
@endsection

@section('script')
{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    flatpickr('#time_input',{
  		enableTime:true,
  		enableSeconds:true,
  		noCalendar: true,
	});
</script> --}}
@endsection