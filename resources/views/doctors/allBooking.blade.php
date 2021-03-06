@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Bookings</li>
    </ol>


    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Booking List</h2> 
        <div class="filter">
          <select onchange="if (this.value) window.location.href=this.value" name="orderby" class="selectbox">
            <option value="">Any status</option>
            <option value="{{route('doctor.bookings')}}">All</option>
            <option value="{{route('doctor.bookings')}}?status=1">Pending</option>
            <option value="{{route('doctor.bookings')}}?status=2">Paid</option>
            <option value="{{route('doctor.bookings')}}?status=3">Ongoing</option>
            <option value="{{route('doctor.bookings')}}?status=4">Caancelled</option>
          </select>
        </div>
      </div>
      <div class="list_general">
       <table class="table table-bordered table-responsive">
      <thead>
        <tr>
          <th></th>
          <th>Patient name</th>
          <th>Booking date</th>
          <th>Duration</th>
          <th>Consultation type</th>
          <th>Status</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($bookings as $booking)
        <tr>
          <td>
            <img src="{{!empty($booking->patient->image)?asset( $booking->patient->image):asset('img/user.png')}}" alt=" {{$booking->patient->fullname}}" style="border-radius: 50%" width="30px" height="30px">
          </td>
          <td>{{$booking->patient->fullname}}</td>
          <td>{{date('Y-M-d h:i a',strtotime($booking->start_book_time))}}</td>
          <td>{{$booking->hour}}</td>
          <td>
            {{$booking->consultType->name}}
            @if($booking->consult_type_id==1)
            <p><span class="fa fa-map-marker"></span> {{$booking->patient_location}}</p>
            @endif
          </td>
          <td id="text{{$booking->id}}">
            @if($booking->status==1)
            <span class="text-info">Pending</span>
            @elseif($booking->status==2)
            <span class="text-primary">Paid but not started</span>
            @elseif($booking->status==3)
            <span class="text-success">Ongoing</span>
            @elseif($booking->status==4)
            <span class="text-success">Complete</span>
             @elseif($booking->status==5)
            <span class="text-info">Flag by doctor</span>
            @elseif($booking->status==6)
            <span class="text-danger">Refunded</span>
             @elseif($booking->status==0)
            <span class="text-success">Mark for refund</span>
            @endif
          </td>
          <td>

          <a class="btn btn-sm btn-primary" href="{{route('doctor.showBooking',$booking->id)}}">View</a>
          </td>
          <td>
            @if($booking->status==2)
            <button id="s{{$booking->id}}" data-id="{{$booking->id}}" class="btn-sm btn-outline-warning start">Start</button>
            @elseif($booking->status==3)
            <button id="p{{$booking->id}}" data-id="{{$booking->id}}" class="btn btn-outline-info pay">Mark as complete</button>
            @else
            -
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    
      </div>
      {{$bookings->links()}}
      <br/>
    <br/>
    </div>
   

</div>
@endsection



@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.pay').click(function(){
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
var book=$(this).attr('data-id');
$('#p'+book).html('Wait...')
$('#p'+book).prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("doctor.markComplete") }}',
    data: {book: book},
    success: function (data){
      $('#r'+book).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Success...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#p'+book).hide();
       //$('#v'+book).modal('hide');
       $('#text'+book).text('Flag by doctor');
        console.log("File has been successfully removed!!");
    },
    error: function(e) {
        console.log(e);
        $('#p'+book).html('Mark as complete')
$('#p'+book).prop('disabled',false)
    }});
}

})
    })

    $('.start').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You want to start",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
var book=$(this).attr('data-id');
$('#s'+book).html('Wait...')
$('#s'+book).prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("doctor.startBook") }}',
    data: {book: book},
    success: function (data){
      $('#s'+book).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Success...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#s'+book).hide();
       //$('#v'+book).modal('hide');
       $('#text'+book).text('Ongoing');
        console.log("File has been successfully removed!!");
    },
    error: function(e) {
        console.log(e);
        $('#s'+book).html('Mark as complete')
$('#s'+book).prop('disabled',false)
    }});
}

})
    })
  
   $('.refund').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You want to refunded",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
var book=$(this).attr('data-id');
$('#r'+book).html('Wait...')
$('#r'+book).prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("admin.bookRefund") }}',
    data: {book: book},
    success: function (data){
      $('#r'+book).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Success...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#r'+book).hide();
       $('#p'+book).hide();
       $('#v'+book).modal('hide');
       $('#text'+book).text('Refunded');
        console.log("File has been successfully removed!!");
    },
    error: function(e) {
        console.log(e);
        $('#r'+book).html('Refund')
$('#r'+book).prop('disabled',false)
    }});
}

})
    })
  })  
</script>

@endsection