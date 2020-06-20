@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Test Prescriptions</li>
    </ol>


    <div class="box_general">
      
      <div class="list_general">
        @forelse($books as $book)
        <div class="card">
          <div class="card-header">
            <h6>Doctor:{{$book->doctor->fullname}}</h6>
            <h6>Bookindg date:{{$book->start_book_time}}</h6>
          </div>
          <div class="card-body">
            @if($book->tests->count())
            <table class="table table-responsive">
      <thead>
        <tr style="border: 1px solid #d0d0d0">
          <th></th>
          <th>Test</th>
          
          <th>Status</th>
          <th>Date</th>
          
        </tr>
      </thead>
      <tbody>
        @foreach($book->tests as $test)
        <tr style="border: 1px solid #d0d0d0">
          <td>
            @if($test->status==0)
            <a href="{{route('patient.labStore',$book->id)}}" style="color: #009900" class="">Go to store</a>
            @endif
          </td>
          <td>{{$test->test}}</td>
          
          <td>
            @if($test->status==0)
            <span class="text-info">Pending</span>
            @elseif($test->status==1)
            <span class="text-primary">Paid</span>
            @elseif($test->status==3)
            <span class="text-success">Ongoing</span>
            @elseif($test->status==4)
            <span class="text-danger">Closed</span>
            @endif
          </td>
          <td>{{date('Y-M-d h:i a',strtotime($test->created_at))}}</td>
        </tr>
        
        @endforeach
      </tbody>
    </table>
    @else
    <p class="text-danger">No test prescribed</p>
    @endif
          </div>
        </div>
        <br/>
        @empty

        @endforelse
      
   
      </div>
       {{$books->links()}}
        <br/>
    <br/>
    </div>
   

</div>
@endsection