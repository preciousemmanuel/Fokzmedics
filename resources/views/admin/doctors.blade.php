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
        <li class="breadcrumb-item active">Doctors</li>
    </ol>


    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Doctors</h2> 
        <div class="filter" style="width: 278px">
          <select onchange="if (this.value) window.location.href=this.value" name="orderby" class="">
           <option value="">Search by specialization</option>
            <option value="{{route('admin.doctors')}}">All</option>
            @foreach($specializations as $specialization)
            <option value="{{route('admin.doctors')}}?specialization={{$specialization->id}}">{{$specialization->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="list_general">
         <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for doctor's name..">
       <table id="myTable" class="table table-bordered table-responsive">
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Specialization</th>
          <th>Joined</th>
          <th>State</th>
          <th>City</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($doctors as $doctor)
        <tr>
          <td>
            <img src="{{!empty($doctor->image)?asset( $doctor->image):asset('img/user.png')}}" alt=" {{$doctor->fullname}}" style="border-radius: 50%" width="30px" height="30px">
          </td>
          <td>Dr. {{$doctor->fullname}}</td>
          <td>{{$doctor->email}}</td>
          <td>{{$doctor->phone}}</td>
          <td>{{(isset($doctor->specialization_id)?$doctor->specialization->name:"Not set")}}</td>
          <td>{{date('Y-M-d',strtotime($doctor->created_at))}}</td>
          <td>{{$doctor->state}}</td>
          <td>{{$doctor->city}}</td>
          <td>
            @if($doctor->approved)
            <span class="text-success fa fa-check-square-o" title="Approve"></span>
            @else
            <span class="text-danger fa fa-ban" title="Disapprove"></span>
            @endif
          </td>
          <td>
           <button class="btn-primary" data-toggle="modal" data-target="#btn{{$doctor->id}}"><span class="fa fa-eye"></span></button>

           <!--edit modal -->
         <div class="modal fade" id="btn{{$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View more</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="modal-body">

          <p>Total Appointments : {{$doctor->doctorAppointments->count()}}</p>
          <p>Referal : {{empty($doctor->referal)?'No referal':$doctor->referal}}</p>
           <p>Address : {{$doctor->address}}</p>
          <p>Bank name : {{$doctor->accnt_bank}}</p>
          <p>Account number : {{$doctor->accnt_num}}</p>
          <p>Account name : {{$doctor->accnt_name}}</p>
            @if(!empty($doctor->licence))
            <a href="{{asset($doctor->licence)}}" download>View licence</a>
            @endif
          </div>
          <div class="modal-footer">
            <div>
              @if($doctor->approved)
              <button id="r{{$doctor->id}}" data-id="{{$doctor->id}}" data-type="disapprove" class="btn btn-outline-danger action">Disapprove</button>
              @else
              <button id="r{{$doctor->id}}" data-id="{{$doctor->id}}" data-type="approve" class="btn btn-outline-success action">Approve</button>
              @endif
            </div>
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
    
       {{$doctors->appends(['specialization'=>request()->query('specialization'),'search'=>request()->query('search')])->links()}}

    <br/>

    <br/>
    </div>
   

</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click',".action",function(){
          Swal.fire({
  title: 'Are you sure?',
  text: "You want to continue",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
var doctor=$(this).attr('data-id');
var type=$(this).attr('data-type');
$('#r'+doctor).html('Wait...')
$('#r'+doctor).prop('disabled',true)

 
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'PUT',
    url: '{{ route("admin.approval") }}',
    data: {type: type,user:doctor},
    success: function (data){
      $('#r'+doctor).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Success...",
                  showConfirmButton: false,
                  timer: 2500
                });
        console.log("File has been successfully removed!!");
    },
    error: function(e) {
        console.log(e);
        $('#r'+doctor).html('action')
$('#r'+doctor).prop('disabled',false)
    }});
}

})
    })
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