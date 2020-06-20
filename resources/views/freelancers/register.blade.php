@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('freelancer.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Register patient</li>
      </ol>
     
      <form action="{{route('freelancer.addPatient')}}" method="POST" enctype="multipart/form-data">
      	
      	@csrf
       @include('partials.error')
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Register a patient</h2>
				
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Name</label>
						<input type="text" required class="form-control" name="fullname"  placeholder="Fullname">
					</div>
				</div>
				
			</div>
			<!-- /row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Phone number</label>
						<input type="text" required class="form-control" name="phone"  placeholder="Phone contact">
					</div>
				</div>
				<div class="col-md-6">
		          <div class="form-group">
		            <label>Email</label>
		            <input type="text"  required class="form-control" name="email"  placeholder="Please fill email address ">
		          </div>
        	  </div>
				
			</div>
			<!-- /row-->
			
			<!-- /row-->
		</div>
		<!-- /box_general-->

   
   
      <button type="submit" name="submit" class="btn_1 medium btn-success">Submit</button>
      <!-- /row-->
    </div>

    <!-- /box_general-->
		<!-- /box_general-->
		
  </form>
	  
	
@endsection

@section('css')

@endsection

@section('script')

@endsection