@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Uploaded prescriptions</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Uploaded prescriptions</h2> 
        
      </div>
      <div class="list_general">
     <table class="table table-stripped  " style="display:inline-block !important">
     <thead>
        <tr>
         
          <th>Prescription</th>
          <th>Type</th>
          <th>Patient name</th>
          <th>Delivery address</th>
          <th>Cost(N)</th>
          <th>Patient Remark</th>
          <th></th>   
        </tr>
      </thead>
      <tbody>
        @forelse($prescriptions as $drug)
        <tr>
        <td >
          <iframe frameborder="0" scrolling="no" width="70%" height="100%" src="{{asset($drug->prescription)}}"></iframe>
        </td>
        <td>{{$drug->type}}</td>
        <td>{{$drug->user->fullname}}</td>
        <td>{{$drug->location}}</td>
        <td>{{$drug->cost}}</td>
        <td>{{$drug->remark}}</td>
        
        <td><button title="view drug" data-toggle="modal" data-target="#edit{{$drug->id}}" class="btn btn-sm btn-secondary" >Action</button></td>


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
            @if(empty($drug->cost))

            <form method="POST" action="{{route('admin.addCostPrescription',$drug->id)}}">
            @csrf
            @method('PUT')

              <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Cost(N)</label>
              <input type="number" name="cost" required class="form-control" placeholder="">
            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Remark</label>
              <input type="text"  name="admin_comment"  class="form-control" placeholder="">
            
          </div>
        </div>
      </div>
      <button class="btn btn-sm btn-success">Submit</button>
          </form>

            @endif
          <p>Cost : {{empty($drug->cost)?'Not added by admin':$drug->cost}}</p>
          <p>Admin remark : {{empty($drug->admin_comment)?'Not added by admin':$drug->admin_comment}}</p>
          <p><a href="{{asset($drug->prescription)}}" download>Download prescription file</a></p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
           
          </div>
        
        </div>
      </div>
    </div>
    <!-- end modal -->


        </tr>
        @empty
    <p class="text text-danger">No prescriptions added</p>
        @endforelse
      </tbody>
     </table>
     </div>
     {{$prescriptions->links()}}
     </div>

@endsection

@section('css')

@endsection

@section('script')


@endsection