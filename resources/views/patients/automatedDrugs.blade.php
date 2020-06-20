@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Drug Prescriptions</li>
    </ol>


    <div class="box_general">
      
      <div class="list_general">
        @forelse($books as $book)
        <div class="card">
          <div class="card-header">
            <h6>Prescribed By:{{$book->doctor->fullname}}</h6>
            <h6>Bookindg date:{{$book->start_book_time}}</h6>
          </div>
          <div class="card-body">
            @if($book->drugs->count())
            <table class="table table-responsive">
      <thead>
        <tr style="border: 1px solid #d0d0d0">
          <th></th>
          <th>Drug</th>
          <th>Dosage Form</th>
          <th>Duration</th>
          <th>Frequency</th>
          <th>Quantity</th>
          <th>Status</th>
          <th>Date</th>
          
        </tr>
      </thead>
      <tbody>
        @foreach($book->drugs as $drug)
        <tr style="border: 1px solid #d0d0d0">
          <td>
            @if($drug->status==0)
            <a href="{{route('patient.drugStore',$book->id)}}" style="color: #009900" class="">Go to store</a>
            @endif
          </td>
          <td>{{$drug->prescriptions}}</td>
          <td>{{$drug->dosage_form}}</td>
          <td>{{$drug->duration}}</td>
          <td>{{$drug->frequency}}</td>
          <td>{{$drug->quantity}}</td>
          <td>
            @if($drug->status==0)
            <span class="text-info">Pending</span>
            @elseif($drug->status==1)
            <span class="text-primary">Paid</span>
            @elseif($drug->status==3)
            <span class="text-success">Ongoing</span>
            @elseif($drug->status==4)
            <span class="text-danger">Closed</span>
            @endif
          </td>
          <td>{{date('Y-M-d h:i a',strtotime($drug->created_at))}}</td>
        </tr>
        
        @endforeach
      </tbody>
    </table>
    @else
    <p class="text-danger">No drugs prescribed</p>
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