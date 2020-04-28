@extends('layouts.main')

@section('content')

<div class="header-video">
			<div id="hero_video">
				<div class="content">
		<ul class="cb-slideshow">
            <!-- <li><span>Image 01</span><div></div></li>
            <li><span>Image 02</span><div></div></li>
            <li><span>Image 03</span><div></div></li> -->
            <!-- <li><span>Image 04</span><div></div></li>
            <li><span>Image 05</span><div></div></li>
            <li><span>Image 06</span><div></div></li> -->
        </ul>

					<!-- <h3 style="op">Find a Doctor!</h3> -->
					<p style="color: #fff;font-size: 3.8rem; margin: 0; text-transform: uppercase;font-weight: 600;">
						Find a Medic!
					</p>
					<form action="search-doctor" autocomplete="off">
						<div id="custom-search-input">
							<div class="input-group">
								
							<input type="text" autocomplete="off" required name="search" id="search-input" class="search-query" placeholder="Ex. , Name, City...">
							{{-- <input type="submit" class="btn_search" value="Search">
						 --}}
							</div>	
							</div>
						
						
			

					
					<ul class="dp_down" style="">
					</ul>
                       <!--  <li class="search_li"><a href="">fgdd</a></li>  -->
                     	</div>
               </form>     
					
                       
					
			
		
			<!-- <img src="img/video_fix.png" alt="" class="header-video--media" data-video-src="video/intro" data-teaser-source="video/intro" data-provider="" data-video-width="1920" data-video-height="750"> -->
		</div>

	</div>
		
			
		</div>
		<!-- /Header video -->

		
		
		
		<div class="container margin_120_95">
			<div class="main_title">
				<h2>24/7 <strong>online</strong> consultation!</h2><br>
				<p>Enjoy  heart to heart consultation with the best Doctors or  free live chat with a Pharmacist and pick up your online prescription with a prescription code from your choice  pharmacy near you or it is delivered to you at home.</p>
			</div>
		<!--	<div class="row add_bottom_30">
				<div class="col-lg-4">
					<div class="box_feat" id="icon_1">
						<span></span>
						<h3>Find a Doctor</h3>
						<!-- <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p> 
					</div>
				</div>
				<div class="col-lg-4">
					<div class="box_feat" id="icon_2">
						<span></span>
						<h3>View profile</h3>
						<!-- <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p> 
					</div>
				</div>
				<div class="col-lg-4">
					<div class="box_feat" id="icon_3">
						<h3>Book a visit</h3>
						 <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p> 
					</div>
				</div>
			</div>-->
			<!-- /row -->
			<p class="text-center"><a href="{{route('doctors')}}" style="margin-bottom:7px" class="btn_1 medium">Find Doctor</a>&nbsp&nbsp&nbsp<a href="#chat_pharmacist" class="btn_1 medium">Pharmacist</a></p>
			<div class="row" style="margin-top: 10px;position: relative;margin-left: auto;margin-right: auto;">
			
		<div class="container margin_120_95" style="padding-bottom: 20px !important">
			<div class="main_title">
				<h2>Search for <strong>Doctors </strong>  by <strong>specialization</strong></h2>
				
			</div>
			<div class="row">
			
			
			</div>
			<!-- /row -->
			<p class="text-center"><a href="{{route('doctors')}}" class="btn_1 medium">All Doctors</a></p>
		</div>
		<!-- /container -->



		<div class="container margin_120_95" id="chat_pharmacist" style="padding-top: 45px !important">
			<div class="main_title">
				<h2>Chat with A Pharmacist online For Free</h2>
				<br>
			<p><strong>Note: </strong> Pharmacist live chat is for;<strong>    asking about drug interactions, side effects, symptomatic treatment of common ailments, prescription refill, purchase of over the counter drugs and medical appliances</strong>. If your symptoms persists, book an appointment to see a doctor or visit an hospital near you. This is an online consultation and it should not substitute for your doctor's advice.</p><br>
			<h4>Select your category to start consulting.</h4>
			</div>
			<div class="row">
				@foreach($categories as $category)
					<div class="col-lg-3 col-md-6">
					<a href="{{route('listFreelancers',$category->id)}}" class="box_cat_home">
						<i class="icon-info-4"></i>
						<img src="{{asset('img/icon_cat_8.svg')}}" width="60" height="60" alt="">
						<h3>{{$category->name}}</h3>
						
					</a>
				</div>
				@endforeach
				
			</div>
			<!-- /row -->
			<div>
			<p class="text-center"><a href="{{route('allFreelancers')}}" class="btn_1 medium">All Pharmacists</a></p> 
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