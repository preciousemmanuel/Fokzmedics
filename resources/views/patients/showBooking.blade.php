@extends('layouts.dashboard')


@section('style')
.card{
      height: 500px;
      border-radius: 15px !important;
      background-color: rgba(0,0,0,0.4) !important;
      
    }

    .card-header{
      border-radius: 15px 15px 0 0 !important;
      border-bottom: 0 !important;
    }
   .card-footer{
    border-radius: 0 0 15px 15px !important;
      border-top: 0 !important;
  }
@endsection

@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">{{$book->is_chat=='yes'?'Chat':'Booking'}}</li>
    </ol>


    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-calendar"></i>{{$book->is_chat=='yes'?'Chat':'Booking'}} detail   
         
          </h2>
        <button class="btn btn-xs " id="toggle-btn" style="float:right;cursor: pointer;"><i class="fa fa-minus" style="color: #001111"></i></button>
        <div class="clearfix"></div>
      </div>
      <div class="alert alert-info"><a href="{{route('patient.automatedDrugs')}}">Click for all drugs prescribed </a></div>
      <div class="row" id="toggle-div">
      
        
        <div class="col-md-6">
          @if($book->is_chat=="yes")
          @if($book->doctor->last_active> date('Y-m-d H:i:s', strtotime('+20 minutes')))
          <p>Freeelancer pharmacist status: <span class="fa fa-circle text-success"></span></p>
          @else
          <p>Freeelancer pharmacist status: <span class="fa fa-circle text-danger"></span></p>
          @endif
          @endif
             <div class="chat-ul card" id="chatList" style="list-style-type: none;font-weight: bold;font-size: 1.0em">
            <div class="card-header msg_head">
              <span style="color: #ffffff">Conversation</span>
            </div>
            <div class="card-body msg_card_body" id="chatBody">
           <div  v-for="chat in chats">

                <div  class="d-flex justify-content-center mb-4">
                  <div class="msg_cotainer">
                    
                  @{{chat.message}}<br/>
                  <small>@{{chat.user.fullname}}</small>
                  
                </div>
              </div>
                <audio id="myAudio">
  <source src="{{asset('audio/clearly.ogg')}}" type="audio/ogg">
  <source src="{{asset('audio/clearly.mp3')}}" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
              </div>
          </div>
           @if($book->is_chat=="yes")
          @if($book->doctor->last_active> date('Y-m-d H:i:s', strtotime('+20 minutes')))
          <div class="card-footer">
              <div class="input-group">
                {{-- <div class="input-group-append">
                  <span class="input-group-text attach_btn"><i class="fa fa-paperclip"></i></span>
                </div> --}}
                <textarea name="message" id="message" v-model='chatBox' class="form-control type_msg" placeholder="Type your message..."></textarea>
                <div class="input-group-append">
                  <span  class="input-group-text send_btn" @click='sendChat'><i class="fa fa-location-arrow"></i></span>
                </div>
              </div>
            </div>
            @else
            <p class="text-danger">Freelance pharmacist is offline</p>
            @endif
          @else
          @if($book->status==3)
          <div class="card-footer">
              <div class="input-group">
                {{-- <div class="input-group-append">
                  <span class="input-group-text attach_btn"><i class="fa fa-paperclip"></i></span>
                </div> --}}
                <textarea name="message" id="message" v-model='chatBox' class="form-control type_msg" placeholder="Type your message..."></textarea>
                <div class="input-group-append">
                  <span  class="input-group-text send_btn" @click='sendChat'><i class="fa fa-location-arrow"></i></span>
                </div>
              </div>
            </div>
              @elseif($book->status==1)
            <p class="text-danger">Please Pay to continue</p>
            
            @endif
            @endif
          </div>
           

           
        </div>
        <div class="col-md-6 add_top_30">
          <i style="font-weight: bold;">{{$book->is_chat=='yes'?'Freelancer':'Doctor'}} Profile:</i>
          <div class="row">

            <div class="col-md-12">

              <div class="form-group">
                <label>Name</label>
                <p>{{$book->doctor->fullname}}</p>
              </div>
            </div>
           
          </div>
          <!-- /row-->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <p>{{$book->doctor->email}}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                @if($book->is_chat=="yes")
                <label>Category</label>
                <p>{{$book->doctor->freelancercategory->name}}    
                </p>
                @else
                <label>Specialization</label>
                <p>{{$book->doctor->specialization->name}}
                @endif
              </div>
            </div>
          </div>

         
          @if($book->is_chat==null)
          <!-- /row-->
          <hr>
          <h4>Booking Details</h4>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Booking Date</label>
                 <p> {{$book->start_book_time}}
                </p>
              </div>
            </div>
            
          </div>
          @endif
        
        </div>
      </div>
       <hr>
      <h4>Drug Prescriptions you sent</h4>
      @if($book->drugs)
            <a href="{{route('patient.drugStore',$book->id)}}" style="color: #009900" class="btn btn-success">Go to store</a>
            @endif
      <table class="table table-bordered">
        <thead>
          <th>S/N</th>
          <th>Drug</th>
          <th>Dosage Form</th>
          <th>Strength</th>
          <th>Frequency</th>
          <th>Quantity</th>
          <th>Status</th>
          <th>Date sent</th>
        </thead>
        <tbody>
          @forelse($book->drugs as $key=> $drug)
          <tr>
            <td>{{$key +1}}</td>
            <td>{{$drug->prescriptions}}</td>
            <td>{{$drug->dosage_form}}</td>
            <td>{{$drug->strength}}</td>
            <td>{{$drug->frequency}}</td>
            <td>{{$drug->quantity}}</td>
            <td>
              @if($drug->status==0)
              <span class="text text-info">Pending</span>
              @elseif($drug->status==1)
              <span class="text text-success">Paid</span>
              
              @endif
            </td>
            <td>{{$drug->created_at}}</td>
          </tr>
          @empty
            No Drug sent
          @endforelse
        </tbody>
      </table>

      <h4>Tests you sent</h4>
      <table class="table table-bordered">
        <thead>
          <th>S/N</th>
          <th>Name</th>
          
          <th>Date sent</th>
        </thead>
        <tbody>
          @forelse($book->tests as $key=> $test)
          <tr>
            <td>{{$key +1}}</td>
            <td>{{$test->test}}</td>
            
            <td>{{$test->created_at}}</td>
          </tr>
          @empty

          @endforelse
        </tbody>
      </table>
    </div>
   

</div>
@endsection

@section('script')
{{-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script> --}}

<script>
  const app= new Vue({
    el:'#app',
    data:{
      chatBox:'',
      user:{!! auth()->user()->toJson() !!},
      book:{!! $book->toJson() !!},
      chats:{}
    },
    mounted(){
      this.getChats()
      this.listen()
    },
    methods:{
      getChats(){
        axios.get(`/api/book/${this.book.id}/chat`)
        .then((response)=>{
          console.log(response)
          this.chats=response.data;
        }).catch((error)=>{
          console.log(error)
        })
      },
      sendChat(){
        if (this.chatBox!='') {
           axios.post(`/api/book/${this.book.id}/chat`,{
            message:this.chatBox,
           // doctor_id:this.user.id,
            //patient_id:this.book.patient.id,
            user_tye:"patient"
           })
        .then((response)=>{
          console.log(response)
          this.chatBox='';
          this.chats.push(response.data);
        }).catch((error)=>{
          console.log(error)
        })
        }
        //alert(this.chatBox)
      },
      listen(){
        Echo.private('book.'+this.book.id)
        .listen('NewMessage',(chat)=>{
          console.log(chat)
          this.chats.push(chat);
          var x = document.getElementById("myAudio"); 
          x.play();
        })
      }
    }
  });

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    // var pusher = new Pusher('cb6fdb5fd93409f87da0', {
    //   cluster: 'eu',
    //   forceTLS: true
    // });

    // var channel = pusher.subscribe('message-channel');

    // channel.bind('App\\Events\\NewMessage', function(data) {
    //   $('#chatList').append('<li>Patient: '+data.text+'</li>');
    //    if (! ('Notification' in window)) {
    //           alert('Web Notification is not supported');
    //           return;
    //         }

    //     Notification.requestPermission( permission => {
    //       let notification = new Notification('New chat alert!', {
    //         body: data.text, // content for the alert
    //         icon: "https://pusher.com/static_logos/320x320.png" // optional image url
    //       });

    //       // link to page on clicking the notification
    //       notification.onclick = () => {
    //         window.open(window.location.href);
    //       };
    //     });
    // });

    //send chat
    // $('.send_btn').click(function(e){
    //   e.preventDefault()

    //   var message=$('#message').val();
    //   if (!message=="") {
    //     $.ajax({
    //     headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //     type: 'POST',
        // url: '',
    //     data: {message: message},
    //     success: function (data){
    //       $('#message').val('');

          

    //       var chatItem='<div class="d-flex justify-content-end mb-4">'
    //       chatItem+='<div class="msg_cotainer_send">';
    //       chatItem+=data.message;
    //       chatItem+="</div></div>"
    //       $('#chatBody').append(chatItem);
    //         console.log(data);
    //     },
    //     error: function(e) {
    //         console.log(e);
    //     }});

    //   }
    // })
     
  </script>

@endsection