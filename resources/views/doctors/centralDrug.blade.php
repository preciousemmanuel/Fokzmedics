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
          <a href="{{route('freelancer.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Central drugs</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Central drugs</h2> 
        
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