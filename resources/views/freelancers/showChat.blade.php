@extends('layouts.dashboard')

@section('style')
.card{
      height: 500px;
      border-radius: 15px !important;
      background-color: rgba(0,0,0,0.4) !important;
      font-weight:normal;
      color:#ffffff;
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
<div class="container">
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('freelancer.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Chat</li>
    </ol>


    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-calendar"></i>Chat detail   
         
          </h2>
        <button class="btn btn-xs " id="toggle-btn" style="float:right;cursor: pointer;"><i class="fa fa-minus" style="color: #001111"></i></button>
        <div class="clearfix"></div>
      </div>
      <div class="row" id="toggle-div">
      
        
        <div class="col-md-6">
          
          


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
          
          <div class="card-footer">
              <div class="input-group">
                {{-- <div class="input- group-append">
                  <span class="input-group-text attach_btn"><i class="fa fa-paperclip"></i></span>
                </div> --}}
                <textarea name="message" id="message" v-model='chatBox' class="form-control type_msg" placeholder="Type your message..."></textarea>
                <div class="input-group-append">
                  <span  class="input-group-text send_btn" @click='sendChat'><i class="fa fa-location-arrow"></i></span>
                </div>
              </div>
            </div>
             
          </div>
            <div class="well chat-cont" style="max-height: 270px;margin-bottom: 10px;overflow-y: auto;width: 100%;background-color: #f0f0f0;padding: 7px"> 
              
           {{-- <form id="chatForm" method="POST">
             
             <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    
                    <textarea rows="5" id="message" class="form-control" name="message" style="height:100px;" placeholder="Enter chat message"></textarea>
                  </div>
                </div>
              </div>
              <button class="btn_1" type="submit">Send</button>
            </form> --}}
            </div>
           <a class="btn btn-sm btn-outline-success" href="{{route('freelancer.listDrugs',$book->id)}}" >Drug</a>
        <button class="btn btn-sm btn-outline-primary" data-target='#testModal' data-toggle="modal">Test</button>
        </div>
        
        <div class="col-md-6 add_top_30">
          <i style="font-weight: bold;">Patients Profile:</i>
          <div class="row">

            <div class="col-md-12">

              <div class="form-group">
                <label>Name</label>
                <p>{{$book->patient->fullname}}</p>
              </div>
            </div>
           
          </div>
          <!-- /row-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
                <p>{{$book->patient->email}}</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Gender</label>
                <p>{{$book->patient->gender}}    
                </p>
              </div>
            </div>
          </div>

         

          
        <button class="btn btn-outline-success" data-toggle="modal" data-target="#extraModal">Extra Info</button>

{{-- 
        <div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-secondary">Drug Presc.</button>
  <button type="button" class="btn btn-secondary">Test Presc.</button>
  
</div> --}}
        </div>



      </div>
    </div>
   

</div>


  
    <div class="modal fade" id="drugModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Extra Info
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
          <form method="POST" action="{{route('doctor.sendExtra',$book->id)}}">
            @method('PUT')
            @csrf
          <div class="row">
          
          <div class="col-md-12">
            <div class="form-group">
              <label style="">Complaints </label>
              <textarea value="" required name="complaints"  placeholder="Complaints..." class="form-control">{{$book->complaints}}</textarea>
            </div>
          </div>
          

         <div class="col-md-12">
          <div class="form-group">
            
          <label>Examination </label>
          
          <textarea required name="examination" placeholder="Examination..." value="" class="form-control">{{$book->examination}}</textarea>
            
          </ul>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
          <label>Diagnosis</label>
        <textarea required name="diagnosis" value="" placeholder="Diagnosis..." class="form-control">{{$book->diagnosis}}</textarea>
          </div>
        </div>

       
      </div>

      
       
        <button type="submit" name="submit" id="send_drug1" class="btn_1 btn-success pull-right">Send</button>
      </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            
            
          </div>
        </div>
      </div>
    </div>

     <!-- Modal for extra-->
    <div class="modal fade" id="extraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Extra Info
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
          <form method="POST" action="{{route('doctor.sendExtra',$book->id)}}">
            @method('PUT')
            @csrf
          <div class="row">
          
          <div class="col-md-12">
            <div class="form-group">
              <label style="">Complaints </label>
              <textarea value="" required name="complaints"  placeholder="Complaints..." class="form-control">{{$book->complaints}}</textarea>
            </div>
          </div>
          

         <div class="col-md-12">
          <div class="form-group">
            
          <label>Examination </label>
          
          <textarea required name="examination" placeholder="Examination..." value="" class="form-control">{{$book->examination}}</textarea>
            
          </ul>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
          <label>Diagnosis</label>
        <textarea required name="diagnosis" value="" placeholder="Diagnosis..." class="form-control">{{$book->diagnosis}}</textarea>
          </div>
        </div>

       
      </div>

      
       
        <button type="submit" name="submit" id="send_drug1" class="btn_1 btn-success pull-right">Send</button>
      </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            
            
          </div>
        </div>
      </div>
    </div>
     <!-- Modal for lab test request-->
    <div class="modal fade" id="drugModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Send drug prescription</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
          <form method="POST" action="{{route('doctor.sendDrug',$book->id)}}">
            @csrf
          <div class="row">
          
          <div class="col-md-12">
            <div class="form-group">
              <label style="">Drug Name </label>
              <input type="text" id="drug_suggestion" name="drug" class="form-control drug_suggestion" placeholder="Type drug name" />
            </div>
          </div>
          

         <div class="col-md-12">
          <div class="form-group">
            
          <label>Dose </label>
          
          <input name="dose" id="dose_suggestion" required class="form-control dose_suggestion"  placeholder="Type Dose"/>
           <ul class="dp_down1">
            
          </ul>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            
          <label>Dosage Form </label>
        
          <input type="text" name="dosage_form" id="dosage_suggestion" required class="form-control dosage_suggestion "  placeholder="Type Dosage Form">
           <ul class="dp_down2">
            
          </ul>
          </div>
        </div>

         <div class="col-md-4">
          <div class="form-group">
            
          <label>Frequency</label>
         
          <input type="text" name="frequency" required class="form-control"  placeholder=""/>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            
          <label>Duration </label>
          <input type="text" name="duration" required class="form-control"  placeholder=""/>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            
          <label>Quantity to be Dispense</label>
          <input type="number" name="quantity" required class="form-control"  placeholder=""/>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Doctors Comment</label>
            <textarea rows="5" name="doc_comment" class="form-control" style="height:100px;" placeholder="Doctors comment"></textarea>
          </div>
        </div>
      </div> 
      
       
        <button type="submit" name="submit" id="send_drug1" class="btn_1 btn-success pull-right">Send</button>
      </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            
            
          </div>
        </div>
      </div>
    </div>


 <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Send Lab Test</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="{{route('doctor.sendTest',$book->id)}}" method="POST">
            @csrf
            <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <label style="padding-left: 5px;font-weight: bold;">Test </label>
          
          <input type="text" id="test_suggestion" name="test" class="test_suggestion form-control" placeholder="Type test" />
          
        
          
          <ul class="dp_down">
            
          </ul>
        </div>
        
      </div>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label>Doctors Comment</label>
            <textarea rows="5" name="doc_comment" class="form-control" style="height:100px;" placeholder="Doctors comment"></textarea>
          </div>
        </div>
      </div> 
      
        <button type="submit" name="submit" id="send_lab1" class="btn_1 ">Send</button>
      </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            
            
          </div>
        </div>
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
            doctor_id:this.user.id,
            patient_id:this.book.patient.id,
            user_tye:"doctor"
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
         // alert()
          console.log('uouio',chat);
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