@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('pharmacy.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Complete / Update Profile/ Settings</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Drugs</h2> 
        <div class="filter">
        <button class="btn btn-success " data-toggle="modal" data-target="#drugModal">Add</button>
        </div>
      </div>
      <div class="list_general">
     <table id="myTable" class="table table-stripped table-bordered table-responsive" style="display:inline-block !important">
     <thead>
        <tr>
         
          <th>Generic Name</th>
          <th>Trade Name</th>
          <th>Quantity</th>
          <th>Strength</th>
          <th>Dosage Form</th>
          <th>Tablet Type</th>
          <th>Cost</th>
          <th></th>   
        </tr>
      </thead>
      <tbody>
        @forelse($drugs as $drug)
        <tr>
        <td style="width:75%">{{$drug->generic_name}}</td>
        <td>{{$drug->trade_name}}</td>
        <td>{{$drug->quantity}}</td>
        <td>{{$drug->strength}}</td>
        <td>{{$drug->dosage_form}}</td>
        <td>{{$drug->tablet_type}}</td>
        <td>{{$drug->price}}</td>
        <td><button title="Edit drug" data-toggle="modal" data-target="#edit{{$drug->id}}" style="outline: none;border: none;background: transparent;"><span class="fa fa-pencil text-primary"></span></button></td>


        <!--edit modal -->
         <div class="modal fade" id="edit{{$drug->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Drug</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('pharmacy.updateDrug',$drug->id)}}">
            @csrf
            @method('PUT')
            
          <div class="modal-body">
          <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Generic name</label>
              <input type="text" value="{{$drug->generic_name}}" name="generic_name" required class="form-control" placeholder="">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Trade name</label>
              <input type="text" value="{{$drug->trade_name}}" name="trade_name" required class="form-control" placeholder="">
            
          </div>
        </div>
      </div>

       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Quantity</label>
              <input type="number" value="{{$drug->quantity}}" name="quantity" required class="form-control" placeholder="">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Cost Per Quantity (N)</label>
              <input type="number" value="{{$drug->price}}" name="price" required class="form-control" placeholder="">
            
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Strength</label>
              <input type="text" name="strength" value="{{$drug->strength}}" required class="form-control" placeholder="">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Dosage Form</label>
              <input type="text" name="dosage_form" value="{{$drug->dosage_form}}" required class="form-control" placeholder="">
            
          </div>
        </div>
      </div>
     <div class="row">
      <div class="col-md-6">
      <div class="form-group">
      <label>Tablet Type</label>
       <select class="form-control" name="tablet_type" id="type_tablet">
         <option value="">Choose tablet type </option>
         <option value="Satchet">Satchet</option>
         <option value="Pack">Pack</option>
         <option value="Unit">Unit</option>
       </select>
     </div>
   </div>
   <div class="col-md-6" style="display: none;" id="show_num_tablet">
    <div class="form-group">
    <label>Number of Tablet</label>
     <input type="number" class="form-control" value="0" id="num_tablet" name="num_tablet">
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
    <!-- end modal -->


        </tr>
        @empty
    <p class="text text-danger">No Drugs added</p>
        @endforelse
      </tbody>
     </table>
     </div>
     </div>

     <div class="modal fade" id="drugModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Drug</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('pharmacy.storeDrug',$user->id)}}">
          	@csrf
          	
          <div class="modal-body">
            <center>
              <a href="{{route('pharmacy.importExcel')}}" class="btn btn-sm btn-outline-success">Upload From Excel</a>
            </center>
            
          <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Generic name</label>
              <input type="text"  name="generic_name" required class="form-control" placeholder="">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Trade name</label>
              <input type="text" name="trade_name" required class="form-control" placeholder="">
            
          </div>
        </div>
      </div>

       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Quantity</label>
              <input type="number" name="quantity" required class="form-control" placeholder="">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Cost Per Quantity (N)</label>
              <input type="number" name="price" required class="form-control" placeholder="">
            
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Strength</label>
              <input type="text" name="strength" required class="form-control" placeholder="">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Dosage Form</label>
              <input type="text" name="dosage_form" required class="form-control" placeholder="">
            
          </div>
        </div>
      </div>
     <div class="row">
      <div class="col-md-6">
      <div class="form-group">
      <label>Tablet Type</label>
       <select class="form-control" required name="tablet_type" id="type_tablet">
         <option value="">Choose tablet type </option>
         <option value="Satchet">Satchet</option>
         <option value="Pack">Pack</option>
         <option value="Unit">Unit</option>
       </select>
     </div>
   </div>
   <div class="col-md-6" style="display: none;" id="show_num_tablet">
    <div class="form-group">
    <label>Number of Tablet</label>
     <input type="number" class="form-control" value="0" id="num_tablet" name="num_tablet">
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
<script type="text/javascript">
  $('#type_tablet').change(function(){
      
      if ($(this).val()==="Unit") {
        $('#show_num_tablet').hide()
        $('#num_tablet').val('0');
        
      }else{
        
        $('#show_num_tablet').show()
        
      }
    })
</script>

@endsection