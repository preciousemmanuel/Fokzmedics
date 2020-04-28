@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
   <button onclick="window.history.back();" href="" class="btn btn-sm btn-outline-primary mb-2">Back</button>
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Drugs</li>
    </ol>


    <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Booking List</h2> 
       
      </div>
      <div class="list_general">
        <form method="POST" action="{{route('freelancer.sendDrug',$book->id)}}">
            @csrf
       <table id="dataTable" class="table table-bordered table-responsive">
      <thead>
        <tr>
          
          <th>Drugs</th>
          <th>Pick</th>
          <th>Dose</th>
          <th>Dosage Form</th>
          <th>Frequency</th>
          <th>Duration</th>
          {{-- <th></th>
          <th></th>
          <th></th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach($drugs as $drug)
        <tr>
          <td>
            {{$drug->generic_name}}
          </td>
          <td>
            <input type="hidden" name="drugs[]" value="{{$drug->generic_name}}">
            <input type="checkbox" name="pick[]">
          </td>
          <td><input type="text" name="dose[]"></td>
          <td><input type="text" name="dosage_form[]"></td>
          <td><input type="text" name="frequency[]"></td>
          <td><input type="text" name="duration[]"></td>
         
        </tr>
        @endforeach
      </tbody>
    </table>
    <button type="submit" class="btn btn-sm btn-success">Submit</button>
  </form>
    <br/>
    <br/>
      </div>
      
    </div>
   

</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $('#dataTable').DataTable();
</script>
@endsection