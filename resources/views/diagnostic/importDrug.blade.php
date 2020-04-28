@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('pharmacy.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Import drug from Excel</li>
      </ol>
     
       
    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Import Drug From Excel</h2>
      </div>
      <div class="row">   
        <div class="col-md-12">
           <form method="post" action="{{route('pharmacy.excelDrugUpload',$user->id)}}" enctype="multipart/form-data" 
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
        Dropzone.options.dropzone ={
            maxFilesize: 1,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: "application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            addRemoveLinks: false,
            timeout: 5000,
            success: function(file, response) {
              Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Upload is sucessful!",
                  showConfirmButton: false,
                  timer: 2500
                });
                console.log(response);
            },
            error: function(file, response)
            {
              Swal.fire({
                  position: 'top-end',
                  type: 'error',
                  title: response,
                  showConfirmButton: false,
                  timer: 2500
                });
              console.log(response)
               return false;
            }
};
</script>

@endsection