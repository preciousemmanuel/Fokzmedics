@extends('layouts.dashboard')

@section('content')


      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('freelancer.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Reviews</li>
      </ol>
      <div class="box_general">
      <div class="header_box">
        <h2 class="d-inline-block">Reviews</h2> 
       
      </div>
      <div class="list_general reviews">
       
     <ul>
       @forelse($reviews as $review)
         <li>
        <span>{{date("Y-M-d ",strtotime($review->create_at))}} </span>
            <span class="rating">
        @switch ($review->rating) 
          @case (5):
            
            <i class="fa fa-star yellow"></i> <i class="fa fa-star yellow"></i> <i class="fa fa-star yellow"></i> 
            <i class="fa fa-star yellow"></i> <i class="fa fa-star yellow"></i>
            
            @break
          @case (4):
            ?>
            <i class="fa fa-star yellow"></i> <i class="fa fa-star yellow"></i> <i class="fa fa-star yellow"></i> 
            <i class="fa fa-star yellow"></i> <i class="fa fa-star "></i>
            
            @break
           @case (3):
            
            <i class="fa fa-star yellow"></i> <i class="fa fa-star yellow"></i> <i class="fa fa-star yellow"></i> 
            <i class="fa fa-star "></i> <i class="fa fa-star "></i>
            
            @break
           @case (2):
            
            <i class="fa fa-star yellow"></i> <i class="fa fa-star yellow"></i> <i class="fa fa-star "></i> 
            <i class="fa fa-star "></i> <i class="fa fa-star "></i>
            
            @break
           @case (1):
            ?>
            <i class="fa fa-star yellow"></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> 
            <i class="fa fa-star "></i> <i class="fa fa-star "></i>
            
            @break;
          @default:
            <i>No star</i>
            @endswitch
        

        </span>
         
             <figure><img src="" alt="{{!empty($booking->patient->image)?asset( $booking->patient->image):asset('img/user.png')}}"></figure>

            <h4>
             {{$review->patient->fullname}}
             <?php
          
            
          ?>
            
            </h4>
            
            <p>{{$review->message}}</p>
            
           <p class="inline-popups">
            
                <button data-toggle="modal" data-target="#g{{ $review->id }}" data-effect="mfp-zoom-in" class="btn_1 gray"><i class="fa fa-fw fa-reply"></i> Reply to this review</button>
                
                <hr/>
                reply
             
            
          <div class="modal fade" id="g{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Reply to this review</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body"> <div class="message-reply margin-top-0">
            
            <form class="reply-review">
              
             
      <div class="form-group">
        <textarea cols="40" rows="3" name="message" class="form-control"></textarea>
      </div>
      <button type="submit" name="submit" class="btn_1">Reply</button>
    </form>
    </div></div>
          <!-- <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div> -->
        </div>
      </div>
    </div>
           </p>
           <!-- Reply to review popup -->
 
    </li>
       @empty
       <p class="text-danger">No reviews </p>
       @endforelse
     </ul>


     </div>

     {{$reviews->links()}}
     </div>

    

@endsection

@section('css')

@endsection

@section('script')

<script type="text/javascript">
  function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
  
</script>

@endsection