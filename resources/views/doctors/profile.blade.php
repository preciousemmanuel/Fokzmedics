@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('doctor.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Complete / Update Profile</li>
      </ol>
     
      <form action="{{route('doctor.update-profile',$user->id)}}" method="POST" enctype="multipart/form-data">
      	@method('PUT')
      	@csrf
       @include('partials.error')
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Basic info</h2>
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
        <div class="col-md-12">
          <div class="form-group">
            <label>Languages Spoken (Seperate with comma)</label>
            <input type="text" value="{{$user->languages}}" class="form-control" name="languages">
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
		
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file-text"></i>Professional</h2>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Professional statement <small>Summary of your career</small></label>
						<textarea rows="5" class="form-control" name="description" style="height:100px;" placeholder="What exactly do you do">{{$user->description}}</textarea>
					</div>
				</div>
			</div>
			<!-- /row-->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Your specialization is <a style="color: #e74e84">{{!empty($user->specialization_id)?$user->specialization->name:''}} </a> </label>
            
						<select required class="form-control" placeholder="Specialization" name="specialization_id" id="specialization">
              <option value="">Change specialization</option>
              @foreach($specializations as $specialization)
              <option 
                @if($user->specialization_id==$specialization->id)
                  selected 
                @endif
               value="{{$specialization->id}}">{{$specialization->name}}</option>
              @endforeach
            </select>
					</div>
				</div>
			</div>
			<!-- /row-->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Education Level or certifations <small>eg: Bsc medicine and surgery. Seperate with comma for more than one</small></label>
            <textarea rows="5" name="education" class="form-control" style="height:100px;" placeholder="Education certifations">{{$user->education}}</textarea>
          </div>
        </div>
      </div>
      <!-- row -->


		</div>
		<!-- /box_general-->

		    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-map-marker"></i>Bank Details</h2>
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
                  <option {{($user->bank_name==$bank->name)?' selected ':'' }}>{{$bank->name}}</option>
                
              @endforeach
            </select>
             
          </div>
        </div>
      </div>
      <!-- /row-->
      
      <!-- /row-->
    </div>

        <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-map-marker"></i>Consultation</h2>
      </div>
      <div class="row">
         <div class="col-md-4">
          <div class="form-group">
            <label>Consulting Type</label>
            <select class="form-control" id="consulting_type" required name="consult_type_id">
              <option value="">Choose consulting type</option>
              @foreach($consultypes as $consulting_type)
                    <option value="{{$consulting_type->id}}" {{$consulting_type->id==$user->consult_type_id?'selected':''}}>{{$consulting_type->name}}</option>
              @endforeach
          
          </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Consulting Duration</label>
            <select class="form-control" required name="consulting_hour">
             <option {{$user->consulting_hour=='5 minutes'?' selected':''}} >5 minutes</option>
             <option {{$user->consulting_hour=='10 minutes'?' selected':''}} >10 minutes</option>
             <option  {{$user->consulting_hour=='15 minutes'?' selected':''}}>15 minutes</option>
          <option {{$user->consulting_hour=='30 minutes'?' selected':''}}>30 minutes</option>
          <option {{$user->consulting_hour=='45 minutes'?' selected':''}}>45 minutes</option>
          <option {{$user->consulting_hour=='1 hour'?' selected':''}}>1 hour</option>
          <option {{$user->consulting_hour=='1 hour 30 minutes'?' selected':''}}>1 hour 30 minutes</option>
          <option {{$user->consulting_hour=='2 hours'?' selected':''}}>2 hours </option>
          <option {{$user->consulting_hour=='3 hours'?' selected':''}}>3 hours</option>
          <option {{$user->consulting_hour=='4 hours'?' selected':''}}>4 hours</option>
          </select>
          </div>
        </div>
         
        <div class="col-md-4">
          <div class="form-group">
            <label>Consulting Fee(Naira) </label>
             <input type="number" min="100" required name="consulting_fee" class="form-control" value="{{$user->consulting_fee}}" placeholder="100" >
          </div>
        </div>
        <div class="col-md-12" id="show_hospital_add" style="display: none;">
          <div class="form-group">
            <label>Write your hospital Address </label>
             <input type="text" name="hospital_address" id="hospital_address" class="form-control" value="{{$user->hospital_address}}" >
          </div>
        </div>
      </div>
      <!-- /row-->
    
      <!-- /row-->
    </div>
    <!-- /box_general-->
		<!-- /box_general-->
		<p><a href="{{route('doctor.index')}}" class="btn btn-danger medium">Cancel</a>   <button type="submit" name="submit" class="btn_1 medium btn-success">Save</button></p>
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

@section('script')
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
