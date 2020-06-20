@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('patient.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Complete / Update Profile</li>
      </ol>
     
      <form action="{{route('patient.update-profile',$user->id)}}" method="POST" enctype="multipart/form-data">
      	@method('PUT')
      	@csrf
       @include('partials.error')
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Profile Details</h2>
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
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Profile picture(Optional but recommended)</label>
						<input type="file" class="form-control" name="image">
					</div>
				</div>
        
			</div>
      <!-- /row-->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control">
              <option {{$user->gender=='male'?' selected':''}} value="male">Male</option>
              <option value="female" {{$user->gender=='female'?' selected':''}}>Female</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Date of Birth</label>
            <input type="text" value="{{$user->date_birth}}" placeholder="Choose your date of birth" class="form-control date_input" name="date_birth">
          </div>
        </div>
      </div>
			<!-- /row-->
		</div>
		<!-- /box_general-->
		
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-map-marker"></i>Address</h2>
			</div>
			
			<!-- /row-->
		 <div class="row">

<div class="col-md-12">
          <div class="form-group">
            <label>Choose Country</label>
            <span class="text-success">*{{$user->country}}*</span>
           <select name="country"  class="countries form-control" id="countryId">
            
              <option value="Nigeria">Nigeria</option>
          </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Choose State</label>
            <span class="text-success">*{{$user->state}}*</span>
            <select name="state" class="states form-control" id="stateId">
              <option value="">Select State</option>
              @foreach ($states as $state) 
                  <option >{{$state->names}}</option>
                
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label id="load" >Choose City</label>
            <span class="text-success">*{{$user->city}}*</span>
            <select name="city" class="cities form-control" id="cityId">
              <option value="">Select City</option>
                
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Residential Address</label>
            <input type="text" name="address" class="form-control" value="{{$user->address}}" placeholder="Your Address" >
          </div>
        </div>
        
      </div>
			<!-- /row-->
		</div>
		<!-- /box_general-->
		
		
		<!-- /box_general-->

		    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-map-marker"></i>Bank Details(Through your bank account we pay you your referal commission)</h2>
      </div>
      
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Account Name</label>
             <input type="text" name="accnt_name" class="form-control" value="{{$user->accnt_name}}" placeholder="Account Name" >
          </div>
        </div>
         <div class="col-md-4">
          <div class="form-group">
            <label>Account Number</label>
             <input type="text" name="accnt_num" class="form-control" value="{{$user->accnt_num}}" placeholder="Account Number" >
          </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            <label>Bank </label>
            <select class="form-control" name="accnt_bank">
              <option>Select Bank</option>
              
                @foreach ($banks as $bank) 
                  <option {{($user->accnt_bank==$bank->name)?' selected ':'' }}>{{$bank->name}}</option>
                
              @endforeach
            </select>
             
          </div>
        </div>
      </div>
      <!-- /row-->
      
      <!-- /row-->
    </div>

    <!-- /box_general-->
		<!-- /box_general-->
		<p><button type="submit" name="submit" class="btn_1 medium btn-success">Save</button></p>
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
{{-- <script src="//geodata.solutions/includes/countrystatecity.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    flatpickr('.date_input',{
      enableTime:false,
      
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#stateId').change(function(){
      $('#load').html('<span class="fa fa-spinner fa-spin" ></span>');
      var state=$(this).val();
      if (state!="") {
        $.ajax({
     headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
      type:'POST',
      url:'{{route('home.getCity')}}',
      data:{state:state},
      success:function(res){
        console.log(res)
        
        $('#cityId').html('');
        
        $('#load').html('Choose City');
          $.each(res,function(index,value){
                $('#cityId').append('<option value="'+value.city+'">'+value.city+'</option>')
            })
        
      
      },error:function(error){
        console.log('ajax error',error)
        spinner.hide();
      }
    })
      }
    })
  })
</script>

@endsection