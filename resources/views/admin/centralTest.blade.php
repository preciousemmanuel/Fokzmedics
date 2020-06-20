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


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('pharmacy.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Central Test</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Central Test</h2> 
        <div class="filter">
        <button class="btn btn-success " data-toggle="modal" data-target="#drugModal">Upload</button>
        </div>
      </div>
      <div class="list_general">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for test names..">
     <table id="myTable" class="table table-stripped  table-responsive" style="display:inline-block !important">
     <thead>
        <tr>
         
          <th>Test Name</th>
          
          <th>Cost</th>
          <th></th>   
        </tr>
      </thead>
      <tbody>
        @forelse($tests as $test)
        <tr>
        <td style="width:75%">{{$test->name}}</td>
        
        <td>{{$test->price}}</td>
        <td><button title="Edit test" data-toggle="modal" data-target="#edit{{$test->id}}" style="outline: none;border: none;background: transparent;"><span class="fa fa-pencil text-primary"></span></button></td>


        <!--edit modal -->
         <div class="modal fade" id="edit{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Test</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('admin.updateTest',$test->id)}}">
            @csrf
            @method('PUT')
            
          <div class="modal-body">
          <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Test name</label>
              <input type="text" value="{{$test->name}}" name="name" required class="form-control" placeholder="">
              <input type="hidden" value="{{$test->id}}" name="test" required class="form-control" placeholder="">
              
            
          </div>
        </div>
        
      </div>

       <div class="row">
       
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Cost Per Quantity (N)</label>
              <input type="number" value="{{$test->price}}" name="price" required class="form-control" placeholder="">
            
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
    <p class="text text-danger">No Test added</p>
        @endforelse
      </tbody>
     </table>


     </div>

     {{$tests->links()}}
     </div>

     <div class="modal fade" id="drugModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Test</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('admin.importTests')}}" enctype="multipart/form-data">
          	@csrf
          	
          <div class="modal-body">
           <p class="text-info"><strong>Note:</strong>Please do not add header titles,just start with the data<p/> <p>Format must be, Test name, and price.</p> 
          <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Upload Central Test Inventory</label>
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
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"> 
@endsection

@section('script')

<script type="text/javascript">
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