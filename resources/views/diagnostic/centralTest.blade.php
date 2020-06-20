@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('diagnostic.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Central tests</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Central tests</h2> 
        <div class="filter">
        <button class="btn btn-success " id="movetest" >Move all to stock</button>
        </div>
      </div>
      <div class="list_general">
     <table class="table table-stripped table-bordered table-responsive" style="display:inline-block !important">
     <thead>
        <tr>
         
          <th>Test</th>
         
          <th>Cost</th>
          <th></th>   
        </tr>
      </thead>
      <tbody>
        @forelse($tests as $test)
        <tr>
        <td style="width:75%">{{$test->name}}</td>
        
        <td>{{$test->price}}</td>
        <td><button title="move test" data-toggle="modal" class="btn btn-outline-primary movetest" id="m{{$test->id}}"  data-id="{{$test->id}}" style=""><span class=" fa fa-arrows "></span> Move</button></td>




        </tr>
        @empty
    <p class="text text-danger">No tests added</p>
        @endforelse
      </tbody>
     </table>


     </div>

     {{$tests->links()}}
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
     $('#movetest').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You want to stock tests",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
//var transaction=$(this).attr('data-id');
$('#movetest').html('Wait...')
$('#movetest').prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("diagnostic.moveTests") }}',
    data: {test: ""},
    success: function (data){
    //  $('#r'+transaction).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "tests moved to stock successfully...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#movetest').html('Move')
$('#movetest').prop('disabled',false)
    },
    error: function(e) {
        console.log(e);
        $('#movetest').html('Move')
$('#movetest').prop('disabled',false)
    }});
}

})
    })
  $('.movetest').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You want to stock this test",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
var test=$(this).attr('data-id');
$('#m'+test).html('Wait...')
$('#m'+test).prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("diagnostic.moveTest") }}',
    data: {test: test},
    success: function (data){
     // $('#r'+transaction).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "test moved to stock successfully...",
                  showConfirmButton: false,
                  timer: 2500
                });
       $('#m').html('Move')
$('#m'+test).prop('disabled',false)
    },
    error: function(e) {
        console.log(e);
        $('#m'+test).html('Move')
$('#m'+test).prop('disabled',false)
    }});
}

})
    })
  })  
</script>
  })
</script>

@endsection