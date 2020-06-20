@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Drug Prescriptions</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <select class="form-control" multiple id="multipleSelector">
          <option selected >Paracetamol</option>
          <option selected>Novagil</option>
        </select>
      </div>
    </div>
    <br/>
<div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Bookings List</h2>
        
      </div>
      <div class="list_general">
        <ul>
          <li>
            <figure><img src="img/avatar1.jpg" alt=""></figure>
            <h4>Enzo Ferrari <i class="pending">Pending</i></h4>
            <ul class="booking_details">
              <li><strong>Booking date</strong> 11 November 2017</li>
              <li><strong>Booking time</strong> 10.20AM</li>
              <li><strong>Visits</strong> Cardiology test, Diabetic diagnose</li>
              <li><strong>Telephone</strong> 0043 432324</li>
              <li><strong>Email</strong> user@email.com</li>
            </ul>
            <ul class="buttons">
              <li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Approve</a></li>
              <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li>
            </ul>
          </li>
          <li>
            <figure><img src="img/avatar2.jpg" alt=""></figure>
            <h4>Andrea Lomarco <i class="cancel">Cancel</i></h4>
            <ul class="booking_details">
              <li><strong>Booking date</strong> 11 November 2017</li>
              <li><strong>Booking time</strong> 10.20AM</li>
              <li><strong>Visits</strong> Cardiology test, Diabetic diagnose</li>
              <li><strong>Telephone</strong> 0043 432324</li>
              <li><strong>Email</strong> user@email.com</li>
            </ul>
            <ul class="buttons">
              <li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Approve</a></li>
              <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li>
            </ul>
          </li>
          <li>
            <figure><img src="img/avatar3.jpg" alt=""></figure>
            <h4>Marc Twain <i class="approved">Approved</i></h4>
            <ul class="booking_details">
              <li><strong>Booking date</strong> 11 November 2017</li>
              <li><strong>Booking time</strong> 10.20AM</li>
              <li><strong>Visits</strong> Cardiology test, Diabetic diagnose</li>
              <li><strong>Telephone</strong> 0043 432324</li>
              <li><strong>Email</strong> user@email.com</li>
            </ul>
            <ul class="buttons">
              <li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Approve</a></li>
              <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
   

</div>
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#multipleSelector').select2();
  })
</script>
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
@endsection