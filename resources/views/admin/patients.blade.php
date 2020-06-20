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
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Patients</li>
    </ol>


    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Patients</h2> 
        
      </div>
      <div class="list_general">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for patient name..">
       <table id="myTable" class="table table-bordered table-responsive">
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Gender</th>
          <th>Joined</th>
          <th>State</th>
          <th>City</th>
          
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($patients as $patient)
        <tr>
          <td>
            <img src="{{!empty($patient->image)?asset( $patient->image):asset('img/user.png')}}" alt=" {{$patient->fullname}}" style="border-radius: 50%" width="30px" height="30px">
          </td>
          <td>{{$patient->fullname}}</td>
          <td>{{$patient->email}}</td>
          <td>{{$patient->phone}}</td>
          <td>{{$patient->gender}}</td>
          <td>{{date('Y-M-d',strtotime($patient->created_at))}}</td>
          <td>{{$patient->state}}</td>
          <td>{{$patient->city}}</td>
           
          <td>
           <button class="btn-primary" data-toggle="modal" data-target="#btn{{$patient->id}}"><span class="fa fa-eye"></span></button>

           <!--edit modal -->
         <div class="modal fade" id="btn{{$patient->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View more</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="modal-body">
          <p>Referal : {{empty($patient->referal)?'No referal':$patient->referal}}</p>
          <p>Address : {{$patient->address}}</p>
          <p>Bank name : {{$patient->accnt_bank}}</p>
          <p>Account number : {{$patient->accnt_num}}</p>
          <p>Account name : {{$patient->accnt_name}}</p>
         
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
           
          </div>
        
        </div>
      </div>
    </div>
    <!-- end modal -->
          </td>
          
        </tr>
        @endforeach
      </tbody>
    </table>

    
      </div>
    
       {{$patients->links()}}

    <br/>

    <br/>
    </div>
   

</div>
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
    td = tr[i].getElementsByTagName("td")[1];
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