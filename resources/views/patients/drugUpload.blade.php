@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('patient.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Upload Prescription</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Upload Prescription</h2> 
        <div class="filter">
        <button class="btn btn-success " data-toggle="modal" data-target="#drugModal"><span class="fa fa-plus"></span> Send</button>
        </div>
      </div>
      <div class="list_general">
     <table class="table table-stripped  " style="display:inline-block !important">
     <thead>
        <tr>
         
          <th>Prescription</th>
          <th>Location</th>
          <th>Type</th>
          <th>Remark</th>
          <th></th>   
        </tr>
      </thead>
      <tbody>
        @forelse($drugs as $drug)
        <tr>
        <td >
          <iframe frameborder="0" scrolling="no" width="70%" height="100%" src="{{asset($drug->prescription)}}"></iframe>
        </td>
        <td>{{$drug->location}}</td>
        <td>{{strtoupper($drug->type)}}</td>
        <td>{{$drug->remark}}</td>
        
        <td><button title="view drug" data-toggle="modal" data-target="#edit{{$drug->id}}" style="outline: none;border: none;background: transparent;"><span class="fa fa-eye text-primary"></span></button></td>


        <!--edit modal -->
         <div class="modal fade" id="edit{{$drug->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View more</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="modal-body">
          <p>Cost : {{empty($drug->cost)?'Not added by admin':$drug->cost}}</p>
          <p>Admin remark : {{empty($drug->admin_comment)?'Not added by admin':$drug->admin_comment}}</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
           
          </div>
        
        </div>
      </div>
    </div>
    <!-- end modal -->


        </tr>
        @empty
    <p class="text text-danger">No Prescription added</p>
        @endforelse
      </tbody>
     </table>
     </div>
     </div>

     <div class="modal fade" id="drugModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Send Prescription</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" enctype="multipart/form-data" action="{{route('patient.saveDrugUpload')}}" >
          	@csrf
          	
          <div class="modal-body">
            
            
          <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Prescription(File must be image or pdf)</label>
              <input type="file"  name="prescription" required class="form-control" placeholder="">
            
          </div>
        </div>
       
      </div>

       <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Patient location</label>
              <input type="text" name="location" required class="form-control" placeholder="">
            
          </div>
        </div>
        
      </div>
       <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Type</label>
             <select class="form-control" name="type">
               <option value="drug">Drug</option>
               <option value="test">Test</option>
             </select>
          </div>
        </div>
        
      </div>
       <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Remark</label>
             <textarea placeholder="" name="remark" class="form-control"></textarea>
          </div>
        </div>
        
      </div>

    
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
      	</form>
        </div>
      </div>
    </div>

@endsection

@section('css')

@endsection

@section('script')


@endsection