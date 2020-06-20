@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin_doctor">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Licence</li>
      </ol>
     
       
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Upload licence</h2>
			</div>
			<div class="row">		
				<div class="col-md-12">
					 <form method="post" action="{{route('doctor.upload-licence',$user->id)}}" enctype="multipart/form-data" 
                  class="dropzone" id="dropzone">
                  		@method('PUT')
    					@csrf
					</form>   
				</div>
				
			</div>
			<!-- /row-->
			
      
			<!-- /row-->
		</div>
		<!-- /box_general-->
		
		

		</div>
		<!-- /box_general-->


    <!-- /box_general-->
		<!-- /box_general-->
		
	  </div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>	
<script type="text/javascript">
        Dropzone.options.dropzone =
         {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: "image/jpg,image/jpeg,image/png,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/docx,application/pdf,text/plain,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            addRemoveLinks: true,
            timeout: 5000,
            removedfile: function(file) 
            {
                var name = file.upload.filename;
                $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                    type: 'POST',
                    url: '{{ route("doctor.delete-licence",$user->id) }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
};
</script>

@endsection