@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('freelancer.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Settings</li>
      </ol>
     
      <form action="{{route('freelancer.update-profile',$user->id)}}" method="POST" enctype="multipart/form-data">
      	@method('PUT')
      	@csrf
       @include('partials.error')
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Bio/Personal Info</h2>
				<button style="float: right;" type="button" data-toggle="modal" data-target="#passwordModal" class="btn btn-danger pull-right btn-xs">Change password</button>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Name</label>
						<input type="text" required class="form-control" name="fullname" value="{{$user->fullname}}" placeholder="Your first name">
					</div>
				</div>
				
			</div>
			<!-- /row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Phone number</label>
						<input type="text" class="form-control" name="phone" value="{{$user->phone}}" placeholder="Your telephone number">
					</div>
				</div>
				<div class="col-md-6">
		          <div class="form-group">
		            <label>Email</label>
		            <input type="text" disabled required class="form-control" name="email" value="{{$user->email}}" placeholder="Please fill your email address ">
		          </div>
        	  </div>
				
			</div>
			<!-- /row-->
		
      
			<!-- /row-->
		</div>
		<!-- /box_general-->

   
    <!-- /box_general-->
		
	
		
		<!-- /box_general-->

    <!-- /box_general-->
		<!-- /box_general-->

  </form>
	  
	  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('user.updatePassword',$user->id)}}">
          	@csrf
          	@method('PUT')
          <div class="modal-body">
          	 <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" name="password">
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Confirm password</label>
            <input type="password" class="form-control " name="confirmPassword">
          </div>
        </div>
      </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Update</button>
          </div>
      	</form>
        </div>
      </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('script')
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    flatpickr('.date_input',{
      enableTime:false,
      
  });
</script>

@endsection