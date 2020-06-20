@extends('layouts.dashboard')

@section('style')
#myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}
@endsection

@section('content')
<div id="preloader">
    <div data-loader="circle-side"></div>
  </div>

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Central drugs</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Central drugs</h2> 
        <div class="filter">
        <button class="btn btn-success " data-toggle="modal" data-target="#drugModal">Upload</button>
        </div>
      </div>
      <div class="list_general">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for generic names..">
     <table id="myTable" class="table table-stripped table-bordered table-responsive" style="display:inline-block !important">
     <thead>
        <tr>
          <th>Generic Name</th>
          <th>Trade Name</th>
          <th>Quantity</th>
          <th>Strength</th>
          <th>Dosage Form</th>
          <th>Tablet Type</th>
          <th>No. Tablet</th>
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
        <td>{{$drug->num_tablet}}</td>
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
          <form method="POST" action="{{route('admin.updateDrug',$drug->id)}}">
            @csrf
            @method('PUT')
            
          <div class="modal-body">
          <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Generic name</label>
              <input type="text" value="{{$drug->generic_name}}" name="generic_name" required class="form-control" placeholder="">
              <input type="hidden" value="{{$drug->id}}" name="drug" required class="form-control" placeholder="">
            
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
              <input type="number" disabled value="{{$drug->quantity}}" name="quantity" required class="form-control" placeholder="">
            
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
       <select class="form-control type_tablet" data-id="{{$drug->id}}" name="tablet_type" >
         <option value="">Choose tablet type </option>
         <option value="Satchet">Satchet</option>
         <option value="Pack">Pack</option>
         <option value="Unit">Unit</option>
       </select>
     </div>
   </div>
   <div class="col-md-6" style="display: none;" id="show_num_tablet{{$drug->id}}">
    <div class="form-group">
    <label>Number of Tablet</label>
     <input type="number" class="form-control" value="0" id="num_tablet{{$drug->id}}" name="num_tablet">
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

     {{$drugs->links()}}
     <br/><br/>
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
          <form method="POST" action="{{route('admin.importDrugs')}}" enctype="multipart/form-data">
          	@csrf
          	
          <div class="modal-body">
           <p class="text-info"><strong>Note:</strong>Please do not add header titles,just start with the data<p/> <p>Format must be, Generic name,trade name,strength,dosage form,tablet type,number tablet and price.</p> 
          <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Upload Central Drugs Inventory</label>
              <input type="file"  name="file" required class="form-control" placeholder="">
            
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
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('script')
{{-- <script type="text/javascript" src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}

<script type="text/javascript">
  // $('#simpleTable').DataTable();
  // $('#simpleTable1').DataTable({
  //       "order": [[ 1, "desc" ]],
  //        dom: 'Bfrtip',
  //       buttons: [
  //              {
  //               extend:    'copyHtml5',
  //               text:      '<i class="fa fa-files-o"></i>',
  //               titleAttr: 'Copy'
  //           },
  //           {
  //               extend:    'excelHtml5',
  //               text:      '<i class="fa fa-file-excel-o"></i>',
  //               titleAttr: 'Excel'
  //           },
  //           {
  //               extend:    'csvHtml5',
  //               text:      '<i class="fa fa-file-text-o"></i>',
  //               titleAttr: 'CSV'
  //           },
  //           {
  //               extend:    'pdfHtml5',
  //               text:      '<i class="fa fa-file-pdf-o"></i>',
  //               titleAttr: 'PDF'
  //           }
           
  //       ]
  //   } );
  $('.type_tablet').change(function(){
      var id=$(this).attr('data-id')
      if ($(this).val()==="Unit") {
        $('#show_num_tablet'+id).hide()
        $('#num_tablet'+id).val('0');
        
      }else{
        
        $('#show_num_tablet'+id).show()
        
      }
    })


function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

</script>

@endsection