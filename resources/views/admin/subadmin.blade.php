@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Subadmins</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Subadmins</h2> 
        <div class="filter">
        <button class="btn btn-success " data-toggle="modal" data-target="#drugModal">Create</button>
        </div>
      </div>
      <div class="list_general">
     <table class="table table-stripped  table-responsive" style="display:inline-block !important">
     <thead>
        <tr>
         
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Created at</th>
          
          <th></th>   
        </tr>
      </thead>
      <tbody>
        @forelse($admins as $admin)
        <tr>
        <td style="">{{$admin->fullname}}</td>
        <td>{{$admin->email}}</td>
        <td>
          @if($admin->admin_role==1)
          Main admin
          @elseif($admin->admin_role==2)
          Subadmin1
          @elseif($admin->admin_role==3)
          Subadmin2
          @endif

        </td>
        <td>{{$admin->created_at}}</td>
      
        <td>
          @if($admin->approved)
              <button id="r{{$admin->id}}" data-id="{{$admin->id}}" data-type="disapprove" class="btn btn-outline-danger action">Disapprove</button>
              @else
              <button id="r{{$admin->id}}" data-id="{{$admin->id}}" data-type="approve" class="btn btn-outline-success action">Approve</button>
              @endif
        </td>


        <!--edit modal -->
         <div class="modal fade" id="edit{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Drug</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="">
            @csrf
            @method('PUT')
            
          <div class="modal-body">
          <div class="row">
       
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
    <p class="text text-danger">No subadmins</p>
        @endforelse
      </tbody>
     </table>
     </div>
     </div>

     <div class="modal fade" id="drugModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create subadmin</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('admin.createAdmin')}}">
          	@csrf
          	
          <div class="modal-body">
            
            
          <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Name</label>
              <input type="text"  name="fullname" required class="form-control" placeholder="">
            
          </div>
        </div>
        
      </div>

       <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Email</label>
              <input type="email" name="email" required class="form-control" placeholder="">
            
          </div>
        </div>
        
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
              <label>Choose admin type</label>
              <select class="form-control" name="admin_role">
                <option value="1">Main admin</option>
                <option value="2">Subadmin1</option>
                <option value="3">Subadmin2</option>
              </select>
          </div>
        </div>
      </div>
     
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
          </div>
      	</form>
        </div>
      </div>
    </div>

@endsection

@section('css')

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
</script>
@endsection