@extends('layouts.main')

@section('content')
	 <div id="results">
       <div class="container">
           <div class="row">
               <div class="col-md-6">

               	@if(isset($specialization) && request()->query('city'))
                   <h4><strong>Showing {{$doctors->count()}}</strong> results  for {{$specialization->name}} in {{urldecode(request()->query('city'))}}</h4>
                   @elseif(isset($specialization))
                   <h4><strong>Showing {{$doctors->count()}}</strong> results  for {{$specialization->name}}</h4>
                   @elseif(request()->query('city'))
                   <h4><strong>Showing {{$doctors->count()}}</strong> results in {{urldecode(request()->query('city'))}}</h4>
                @else
                <h4><strong>Showing {{$doctors->count()}} results</strong></h4>
                @endif
               </div>
               <div class="col-md-6">
                    <div class="search_bar_list">
                    	
                    <input type="text" autocomplete="off" id="search-input" class="search-query form-control" placeholder="Ex., Name, City of Doctor...">
                    
					<ul class="dp_down" style="">
					</ul>
                
                </div>
               </div>
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
					<h6>Specializations</h6>
					<select onchange="if (this.value) window.location.href=this.value">
						<option value="">Search by specialization</option>
						<option value="{{route('doctors')}}">All</option>
						@foreach($specializations as $specialization)
						<option value="{{route('home.specialization',$specialization->id)}}">{{$specialization->name}}</option>
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
				</li> --}}
				<li>

					<h6>Sort by</h6>
					<select name="orderby" class="selectbox" onchange="if (this.value) window.location.href=this.value">
					@foreach($city as $key => $cit)

						<option value="{{request()->url()}}?city={{urlencode($cit)}}">{{$cit}}</option>
						@endforeach
					</select>
				</li> 
			</ul>
		</div>
		<!-- /container -->
	</div>
	<!-- /filters -->

		<div class="container margin_60_35">
			<div class="row">
				<div class="col-xl-12 col-lg-12">
				<div class="row">
					@forelse($doctors as $doctor)
				<div class="col-md-4">
						<div class="box_list wow fadeIn">
							<a href="#0" class="wish_bt"></a>
							<figure>
								<a href="{{route('viewPractitioner',$doctor->id)}}"><img src="{{!empty($doctor->image)?asset($doctor->image):'http://via.placeholder.com/565x565.jpg'}}" class="img-fluid" alt="">
									<div class="preview"><span>Read more</span></div>
								</a>
							</figure>
							<div class="wrapper">
								<small>{{$doctor->specialization->name}}</small>
								<h3>Dr. {{$doctor->fullname}}</h3>

								<p>{{$doctor->description}}</p>
								<span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></span>
								<a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="img/badges/badge_1.svg" width="15" height="15" alt=""></a>
							</div>
							<ul>
								<li><a href="#0" onclick="onHtmlClick('Doctors', 0)"><i class="icon_pin_alt"></i>{{$doctor->city}}</a></li>
								<li><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" target="_blank"><i class="icon_pin_alt"></i>Directions</a></li>
								<li><a href="{{route('viewPractitioner',$doctor->id)}}">Book now</a></li>
							</ul>
						</div>
					</div>
					@empty
					<p class="text-danger">No doctor</p>
					@endforelse
            	</div>
            
            	{{ $doctors->appends(['search'=>request()->query('search')])->links() }}
				</div>
							
							
				<!-- /asdide -->
			</div>
			<!-- /row -->
		</div>
@endsection



@section('css')
<link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
	$('#search-input').autocomplete({
    
     source: function( request, response ) {
        console.log("request",request.term);
   // Fetch data
   var url='{{route('autocomplete_search')}}';
   $.ajax({
   	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: url,
    type: 'post',
    dataType: "json",
    data: {
     term: request.term,
    },
    success: function( data ) {
        console.log("res",data)
     response( data );
    },
    error:function(data){
    	console.log(data)
    }
    
   });
  },
  select: function (event, ui) {
        console.log("record",ui)
   // Set selection
     var user=ui.item.id; // display the selected text
      // save selected id to input
      window.location.href="/practitioner/"+user
       return false;
    }
}).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li class='search_li'>" )
        .append( "<a title='"+item.specialization+"'>" + item.label + "</a>" )
        .appendTo( ul );
    };;
</script>
@endsection