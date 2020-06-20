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
          <a href="{{route('admin.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Purse</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Purse</h2> 
       <div class="filter">
        @if(count($purses)>0)
        <button class="btn btn-sm btn-success" id="paid">Mark as paid</button>
        @endif
       </div>
      </div>
      <div class="list_general">
       
     <table id="simpleTable1" class="table table-stripped  table-responsive" style="display:inline-block !important">
     <thead>
        <tr>                   
          <th>Acount Number</th>
          <th>Bank Name</th>
          <th>Amount</th>
          <th>Account Name</th>
        </tr>
      </thead>
      <tbody>
        @forelse($purses as $purse)
        <tr>
        <td style="width:75%">{{$purse->accnt_num}}</td>
        <td style="width:75%">{{$purse->accnt_bank}}</td>
        
        <td>{{$purse->amount}}</td>
        <td>{{$purse->accnt_name}}</td>
        


        </tr>
        @empty
    <p class="text text-danger">No Amount in purse</p>
        @endforelse
      </tbody>
     </table>


     </div>

    
     </div>

     
@endsection

@section('css')
 <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"> 
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script type="text/javascript" src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript">
  $('#simpleTable').DataTable();
  $('#simpleTable1').DataTable({
        "order": [[ 1, "desc" ]],
         dom: 'Bfrtip',
        buttons: [
               {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            }
           
        ]
    } );

  $(document).ready(function(){
     $('#paid').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You have paid users",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
var book=$(this).attr('data-id');
$('#paid').html('Wait...')
$('#paid').prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("admin.markPursePaid") }}',
    data: {},
    success: function (data){
     // $('#r'+book).hide();
       Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: "Success...",
                  showConfirmButton: false,
                  timer: 2500
                });
       location.reload()
       // $('#p'+book).hide();
       // //$('#v'+book).modal('hide');
       // $('#text'+book).text('Flag by doctor');
       //  console.log("File has been successfully removed!!");
    },
    error: function(e) {
        console.log(e);
        $('#paid').html('Mark as paid')
$('#paid').prop('disabled',false)
    }});
}

})
    })
  })
</script>

@endsection