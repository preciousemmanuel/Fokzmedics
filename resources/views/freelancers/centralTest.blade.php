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
          <a href="{{route('freelancer.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Central Test</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Central Test</h2> 
       
      </div>
      <div class="list_general">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for test names..">
     <table id="myTable" class="table table-stripped  table-responsive" style="display:inline-block !important">
     <thead>
        <tr>
         
          <th>Test Name</th>
          
          <th>Cost</th>
            
        </tr>
      </thead>
      <tbody>
        @forelse($tests as $test)
        <tr>
        <td style="width:75%">{{$test->name}}</td>
        
        <td>{{$test->price}}</td>
        
        </tr>
        @empty
    <p class="text text-danger">No Test added</p>
        @endforelse
      </tbody>
     </table>


     </div>

     {{$tests->links()}}
     </div>

    

@endsection

@section('css')

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
  
</script>

@endsection