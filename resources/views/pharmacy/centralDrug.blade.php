@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('pharmacy.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Central drugs</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Central drugs</h2> 
        <div class="filter">
        <button class="btn btn-success " id="moveDrug" >Move all to stock</button>
        </div>
      </div>
      <div class="list_general">
     <table class="table table-stripped table-bordered table-responsive" style="display:inline-block !important">
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
        <td><button title="move drug" data-toggle="modal" class="btn btn-outline-primary moveDrug" id="m{{$drug->id}}"  data-id="{{$drug->id}}" style=""><span class=" fa fa-arrows "></span> Move</button></td>




        </tr>
        @empty
    <p class="text text-danger">No Drugs added</p>
        @endforelse
      </tbody>
     </table>


     </div>

     {{$drugs->links()}}
     </div>

    

@endsection

@section('css')
{{-- <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> --}}
@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


<script type="text/javascript">
  
  $('#type_tablet').change(function(){
      
      if ($(this).val()==="Unit") {
        $('#show_num_tablet').hide()
        $('#num_tablet').val('0');
        
      }else{
        
        $('#show_num_tablet').show()
        
      }
    })

  $(document).ready(function(){
     $('#moveDrug').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You want to stock drugs",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
//var transaction=$(this).attr('data-id');
$('#moveDrug').html('Wait...')
$('#moveDrug').prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("pharmacy.moveDrugs") }}',
    data: {drug: ""},
    success: function (data){
    //  $('#r'+transaction).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Drugs moved to stock successfully...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#moveDrug').html('Move')
$('#moveDrug').prop('disabled',false)
    },
    error: function(e) {
        console.log(e);
        $('#moveDrug').html('Move')
$('#moveDrug').prop('disabled',false)
    }});
}

})
    })
  $('.moveDrug').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You want to stock this drug",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
var drug=$(this).attr('data-id');
$('#m'+drug).html('Wait...')
$('#m'+drug).prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("pharmacy.moveDrug") }}',
    data: {drug: drug},
    success: function (data){
     // $('#r'+transaction).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Drug moved to stock successfully...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#m').html('Move')
$('#m'+drug).prop('disabled',false)
    },
    error: function(e) {
        console.log(e);
        $('#m'+drug).html('Move')
$('#m'+drug).prop('disabled',false)
    }});
}

})
    })
  })  
</script>
  })
</script>

@endsection