@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Test Transaction</li>
    </ol>


    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Test Transactions</h2> 
      
      </div>
      <div class="list_general">
       <table class="table table-bordered table-responsive">
      <thead>
        <tr>
          
          <th>Transaction ID</th>
          <th>Tests</th>
          <th>Amount</th>
          <th>Lab</th>
          <th>Date</th>
          <th>Status</th>
          <th></th>
          
        </tr>
      </thead>
      <tbody>
        @foreach($transactions as $transaction)
        <tr>
         
          <td>{{$transaction->trans_ref}}</td>
          <td>{{$transaction->book->drugs->pluck('tests')->implode(', ')}}</td>
          <td>{{$transaction->amount}}</td>
          <td>{{$transaction->lab->fullname}}</td>
          <td>{{date('Y-M-d h:i a',strtotime($transaction->created_at))}}</td>
          
          <td>
            @if($transaction->status==1)
            <span class="text-info">Not recieved</span>
            @elseif($transaction->status==0)
            <span class="text-danger">Mark for refund</span>
            @elseif($transaction->status==2)
            <span class="text-success">Recieved</span>
            @elseif($transaction->status==4)
            <span class="text-danger">Closed</span>
            @endif
          </td>
          <td>
             @if($transaction->status==1 || $transaction->status==0)
             <button id="r{{$transaction->id}}" data-id="{{$transaction->id}}" class="btn btn-sm btn-outline-success recieved">Mark as recieved</button>
             
              @elseif($transaction->status==1 && strtotime($transaction->created_at)< strtotime('-2 days'))
               <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#c{{$transaction->id}}">Complain</button>

                 <div class="modal fade" id="c{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Complaint</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('patient.testComplain')}}">
            @csrf
            @method('PUT')
          <div class="modal-body">
             <div class="row">
              <input type="hidden" name="transaction" value="{{$transaction->id}}">
        <div class="col-md-12">
          <div class="form-group">
            <label>Complain type</label>
            <select class="form-control" name="complainType">
              <option >Not Recieved</option>
              <option >Need Refund</option>
              <option >Not what I need</option>
            </select>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Remark</label>
           <textarea class="form-control" name="remark"></textarea>
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
               @endif
         
          @if(isset($transaction->complainType))
             <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#v{{$transaction->id}}"><span class="fa fa-eye"></span></button>

             @endif


                 <div class="modal fade" id="v{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View complaint</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="modal-body">
            <p>Complain type:{{$transaction->complainType}}</p>
            <p>Complain remark:{{$transaction->remark}}</p>
            <p>Complain date:{{$transaction->complainDate}}</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            
          </div>
        
        </div>
      </div>
    </div>

          </td>
         
        </tr>
        @endforeach
      </tbody>
    </table>
    <br/>
    <br/>
      </div>
      
    </div>
   

</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.recieved').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You want to acknowledge",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
if (result.value) {
var transaction=$(this).attr('data-id');
$('#r'+transaction).html('Wait...')
$('#r'+transaction).prop('disabled',true)
 $.ajax({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    type: 'POST',
    url: '{{ route("patient.markTestRecieved") }}',
    data: {transaction: transaction},
    success: function (data){
      $('#r'+transaction).hide();
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
        $('#r'+transaction).html('Mark as recieved')
$('#r'+transaction).prop('disabled',false)
    }});
}

})
    })
  })  
</script>

@endsection