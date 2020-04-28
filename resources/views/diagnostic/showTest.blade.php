@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('diagnostic.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Test</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Tests</h2> 
        <div class="filter">
        <button class="btn btn-success " data-toggle="modal" data-target="#testModal">Add</button>
        </div>
      </div>
      <div class="list_general">
     <table class="table table-stripped  table-responsive" style="display:inline-block !important">
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
        <td><button title="Edit test" data-toggle="modal" data-target="#edit{{$test->id}}" style="outline: none;border: none;background: transparent;"><span class="fa fa-pencil text-primary"></span></button></td>


        <!--edit modal -->
         <div class="modal fade" id="edit{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit test</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('diagnostic.updateTest',$test->id)}}">
            @csrf
            @method('PUT')
            
          <div class="modal-body">
          <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Test</label>
              <input type="text" value="{{$test->name}}" name="name" required class="form-control" placeholder="">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Price</label>
              <input type="number" value="{{$test->price}}" name="price" required class="form-control" placeholder="">
            
          </div>
        </div>
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
    <p class="text text-danger">No tests added</p>
        @endforelse
      </tbody>
     </table>
     </div>
     </div>

     <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add test</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" action="{{route('diagnostic.storeTest',$user->id)}}">
          	@csrf
          	
          <div class="modal-body">
           
            
          <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Test</label>
              <input type="text"  name="name" required class="form-control" placeholder="">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            
              <label>Price</label>
              <input type="text" name="price" required class="form-control" placeholder="">
            
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

@endsection

@section('css')

@endsection

@section('script')
<script type="text/javascript">
  $('#type_tablet').change(function(){
      
      if ($(this).val()==="Unit") {
        $('#show_num_tablet').hide()
        $('#num_tablet').val('0');
        
      }else{
        
        $('#show_num_tablet').show()
        
      }
    })
</script>

@endsection