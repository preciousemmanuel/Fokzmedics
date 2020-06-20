//this page is for booking,sign in and sign up is for booking
$(document).ready(function(){
	$(document).click(function(){
		$('.dp_down').hide()
	})
	$('#stop_book').click(function(){
		$('#submit1').html('Book Now');	
		$('#submit1').prop('disabled',false);
	})
	$('#booking').unbind('submit').submit(function(e){
		e.preventDefault();
		//get the attribute of form
		
		var form=$(this);
		var data=form.serialize();

		var hour=$('#hour').val();
		var timebook=$('#booking_time').val();
		var datebook=$('#booking_date').val();
		var doctor=$('#doctor').val();
		var amount=$('#amount').val();
		var delivery_location=$('#delivery_location').val();
		$('#submit1').html('<img src="img/small.gif" /> Wait...');
		$('#submit1').prop('disabled',true)
		//check login in status
		$.ajax({
			type:'POST',
			url:"server/check_login_status.php",
			data:{user:"post"},
			cache:false,
			success:function(res){
				var data=JSON.parse(res);
				//alert(data.authenticate)
				if (data.authenticate) {
					//user is authenticated

			if (confirm('Do you want to book this doctor for '+ hour)) {
$('#submit1').html('<img src="img/small.gif" /> Booking...');
		$('#submit1').prop('disabled',true)
		
		$.ajax({
			type:'POST',
			url:"server/booking.php",
			data:data,
			cache:false,
			success:function(res){
				var data=JSON.parse(res);
				if(data.status=="login") {
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
					$('#login-modal').modal('show');
					if (sessionStorage) {
						//if localstorge is enable store into it
					sessionStorage.setItem("doctor", doctor);
					
					sessionStorage.setItem("datebook", datebook);
					//sessionStorage.setItem("ailment", ailment);
					sessionStorage.setItem("timebook", timebook);
					
					sessionStorage.setItem("hour", hour);
					
					} else {
						alert("session storage not working outdated browser")
					}
				}else if (data.status=="success") {
					var book_id=data.book_id;
					var patient_email=data.patient_email;
					var patient_phone=data.patient_phone;
					//alert(patient_email)
					sessionStorage.setItem('book_id',book_id);
					alert("Booking successfull! You are almost done; Pay the doctor's consultancy fee to finish booking process.");

					// $('#submit1').html('Book Now');	
					//$('#submit1').prop('disabled',false);
					//sessionStorage.clear();
					
					$('#login-modal').modal('hide');
					//$('#pay-modal').modal('show');
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
					payment_booking(patient_email,amount,book_id,doctor,patient_phone)
				}
				else if(data.status=="booked"){
										
					alert("Oops!!! Sorry this date and time has already been booked.Try again by choosing another date or time ");

					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
					sessionStorage.clear()
				
				}
				else if(data.status=="sent_home_service")
				{
					
					alert("Home Servce booking Request has been successfully sent to this doctor. A response mail will be sent to you when He accepts");

					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
					location.assign('users/booking_list');
					sessionStorage.clear()
				
				}
				else if(data.status=="invaliddate")
				{
					alert(data.msg);
					//alert("Oops!!! Sorry the date and time must not be less than current date.Try again by choosing another date or time ");

					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
					sessionStorage.clear()
					
				}
				else if (data.status=="invalid_doc_time") {
					alert(data.msg)
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
				}
				else if (data.status=="invalid_doc_day") {
					alert(data.msg)
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
				}
				else if (data.status=="error") {
					alert(data.msg)
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
				}
				
			}
		})
		} 
				} else {
					//not login
					$('#login-modal').modal('show');
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
				}
			}
		})

		
	})
})

// function checkLoginStatus(){
// 	$.ajax({
// 			type:'POST',
// 			url:"server/check_login_status.php",
// 			data:{user:"post"},
// 			cache:false,
// 			success:function(res){
// 				var data=JSON.parse(res);
// 				alert(data.authenticate)
// 				if (data.authenticate) {
// 					return true
// 				} else {
// 					return false
// 				}
// 			}
// 		})
// }

//get session for enquire
function getBookingSess(){
	var doctor=sessionStorage.getItem("doctor");
	var datebook=sessionStorage.getItem("datebook");
	var hour=sessionStorage.getItem("hour");
	var timebook=sessionStorage.getItem("timebook");
	var amount=sessionStorage.getItem("amount");
	//var hour=sessionStorage.getItem("hour");
	
	if ((doctor!=undefined||doctor!=null)&&(datebook!=undefined||datebook!=null)&&(hour!=undefined||hour!=null)&&(timebook!=undefined||timebook!=null)) {
		$.ajax({
			type:'POST',
			url:"server/booking.php",
			data:{doctor:doctor,datebook:datebook,hour:hour,timebook:timebook},
			cache:false,
			success:function(res){
				var data=JSON.parse(res);
				if(data.status=="login") {
					$('#login-modal').modal('show');
					if (sessionStorage) {
						//if localstorge is enable store into it
					sessionStorage.setItem("doctor", doctor);
					
					sessionStorage.setItem("datebook", datebook);
					//sessionStorage.setItem("ailment", ailment);
					sessionStorage.setItem("timebook", timebook);
					
					sessionStorage.setItem("hour", hour);
					
					} else {
						alert("session storage not working outdated browser")
					}
				}else if (data.status=="success") {
					var book_id=data.book_id;
					var patient_email=data.patient_email;
					var patient_phone=data.patient_phone;
					//alert(patient_email)
				alert("Booking successfull! You are almost done; Pay the doctor's consultancy fee to finish booking process.");

					// $('#submit1').html('Book Now');	
					//$('#submit1').prop('disabled',false);
					//sessionStorage.clear();
					
					$('#login-modal').modal('hide');
					//$('#pay-modal').modal('show');
					payment_booking(patient_email,amount,book_id,doctor,patient_phone)
				}
				else if(data.status=="booked"){
										
					alert("Oops!!! Sorry this date and time has already been booked.Try again by choosing another date or time ");

					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
					sessionStorage.clear()
				
				}
				else if(data.status=="sent_home_service")
				{
					
					alert("Home Servce booking Request has been successfully sent to this doctor. A response mail will be sent to you when He accepts");

					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
					location.assign('users/booking_list');
					sessionStorage.clear()
				
				}
				else if(data.status=="invaliddate")
				{
					
					alert(data.msg);
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
					sessionStorage.clear()
					
				}
				else if (data.status=="invalid_doc_time") {
					alert(data.msg)
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
				}
				else if (data.status=="invalid_doc_day") {
					alert(data.msg)
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
				}
				else if (data.status=="error") {
					alert(data.msg)
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
				}
			}
		})
	} 
	else {}
}


//send signin system
$(document).ready(function(){
	$(document).on('submit','#sign-in',function(e){
		e.preventDefault();
		//get the attribute of form
		
		var form=$(this);
		var data=form.serialize();

		$('#signin').html('<img src="img/small.gif"/> Wait...');
		$('#signin').prop('disabled',true)
		$.ajax({
			type:'POST',
			url:"server/signin.php",
			data:data,
			cache:false,
			success:function(res){
				if(res.indexOf("success") > -1)
				{
					
					alert("You have succesfully signin! You may now continue...");

					$('#signin').html('Signin');	
					$('#signin').prop('disabled',false);
					
					getBookingSess();
					
					location.reload();
				}
				else{
					alert(res)
					
					//final_step();
					//$('#add_pricing').form[0].reset()
					$('#signin').prop('disabled',false);
					$('#signin').html('Signin');	


				
				}
				
			}
		})
	})
})

//send signout system
$(document).ready(function(){
	$(document).on('click','#signouts',function(e){
		e.preventDefault();
		//get the attribute of form
	        var data="";
		$.ajax({
			type:'POST',
			url:"server/signout.php",
			data:data,
			cache:false,
			success:function(res){
				sessionStorage.clear();
				localStorage.clear();
				location.reload();
			}
					
		});
		
		
	});
})

function search_doc(){
	$(document).on('keyup','#home-search',function(){
		var text=$(this).val();
		var trim=$.trim(text);
			if (trim!='') {
		
			$.ajax({
		method:'POST',
		data:'text='+text,
		url:"server/search_doc_suggestion.php",
		success:function(data){
			$('.dp_down').show()
			
			$('.dp_down').html(data)
		}
	})
	}
	else{
		$('.dp_down').hide()
	}
			
	})
}
$(document).ready(function(){
	search_doc();
	$('#home-search').attr('autocomplete','off')
	
})


//send signin system
$(document).ready(function(){
	$(document).on('submit','#register_doc',function(e){
		e.preventDefault();
		//get the attribute of form
		
		var form=$(this);
		var data=form.serialize();

		$('#signin').html('<img src="img/small.gif"/> Wait...');
		$('#signin').prop('disabled',true)
		$.ajax({
			type:'POST',
			url:"server/register_doctor.php",
			data:data,
			cache:false,
			success:function(res){
				if(res.indexOf("success") > -1)
				{
					
					alert("You have succesfully signin");

					$('#signin').html('Signin');	
					$('#signin').prop('disabled',false);
					
					getBookingSess();
					
					location.reload();
				}
				else{
					alert(res)
					
					//final_step();
					//$('#add_pricing').form[0].reset()
					$('#signin').prop('disabled',false);
					$('#signin').html('Signin');	


				
				}
				
			}
		})
	})

	//chat now script with patient from landing page
	$('.freelance_chat').unbind('click').click(function(e){
		e.preventDefault();
		//<alert("ds")
		var freelance_id=$(this).attr('data-id');
		var status=$(this).attr('data-st');
		var type=$(this).attr('data-type');
		

		//check login in status
		$.ajax({
			type:'POST',
			url:"server/check_login_status.php",
			data:{user:"post"},
			cache:false,
			success:function(res){
				var data=JSON.parse(res);
				//alert(data.authenticate)
				if (data.authenticate){
					//user is authenticatt
					//get the attribute of form
		$("#freelance-chat"+freelance_id).html("connecting...")
		$("#freelance-chat"+freelance_id).prop("disabled",true)
		var data="";
		$.ajax({
			type:'POST',
			url:"server/chat_with_freelance.php",
			data:{freelance_id:freelance_id,status:status,type:type},
			cache:false,
			success:function(res){
					var a=JSON.parse(res);
					//alert(res)
					var json=JSON.parse(res);
					
					if (json.status==="success") {
						setTimeout(function(){
							
							if (status==1) {
								$('#chat-modal').modal("hide");
								$("#freelance-chat").html("Chat now");
							$("#freelance-chat").attr("data-st",2);
							$("#freelance-chat").removeClass("btn-warning");
							$("#freelance-chat").addClass("btn-success");
							} else {
								//window.location.assign("users/booking_list")
								location.assign(`users/chat?freelance_id=${freelance_id}&patient_id=${json.patient_id}&book_id=${json.book_id}`)
								//$('#chat-modal').modal({backdrop: 'static',keyboard: false})
								$("#freelance-chat"+freelance_id).html("Ongoing Chat");
							$("#freelance-chat"+freelance_id).attr("data-st",1);
							$("#freelance-chat"+freelance_id).removeClass("btn-success");
							$("#freelance-chat"+freelance_id).addClass("btn-warning");
							}
							
						},2000)
					}
					else if(json.status==="login"){
							alert("login first before you continue!")
						$('#login-modal').modal('show');
						$("#freelance-chat"+freelance_id).html("Chat Now")
						$("#freelance-chat"+freelance_id).prop("disabled",false)
					}
					else{
						alert("failed to connect");
						$("#freelance-chat"+freelance_id).html("Chat Now")
						$("#freelance-chat"+freelance_id).prop("disabled",false)
					}
				}
				
			
		})
				}else{
					//user not authenticated
					$('#login-modal').modal('show');
				}
			}
		})

		
	})

	//flutterwave payment gateway
	$(document).on('submit',".pay_book",function(e){
		e.preventDefault();

		var form=$(this);
		var data=form.serialize();
		data=data+"&book_id="+sessionStorage.getItem('book_id');
		$('#pay_btn').html('<img src="img/small.gif"/> Processing...');
		$('#pay_btn').prop('disabled',true)
		$.ajax({
			type:'POST',
			url:"payment-process.php",
			data:data,
			cache:false,
			success:function(res){
				console.log(res)
				// var data=JSON.parse(res);
				// console.log(data)
				if(res.indexOf("success") > -1)
				{
					
					alert("Transaction is successfull");

					$('#pay_btn').html('pay_btn');	
					$('#pay_btn').prop('disabled',false);
					
					window.location.assign("users/booking_list")
				}
				else{
					alert(res)
					
					//final_step();
					//$('#add_pricing').form[0].reset()
					$('#pay_btn').html('Pay');	
					$('#pay_btn').prop('disabled',false);


				
				}
				
			}
		})
	})

})


function payment_booking(email,amount,book_id,doctor_id,phone){
	
		//$('#buy').html("Processing...");
		// var amount=$("#amount").val();
		// var amount=$("#amount").val();
		var txref='Fokz'+ Math.floor((Math.random() * 10000000) + 1);
		$.get('server/get_site_info.php',function(resp){
			var json=JSON.parse(resp);
			console.log(json.config)
		var x = getpaidSetup({
            PBFPubKey: json.config.public_key,
            customer_email: email,
            amount: amount,
            customer_phone: "234"+phone,
            currency: "NGN",
            txref: txref,
            custom_logo:"https://fokzmedics.com/img/logo.png",
           
            custom_title:"Fokzmedics",
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                   process_booking(amount,book_id,doctor_id,txref);
                } else {
                    // redirect to a failure page.
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
	})
    
}

function process_booking(amount,book_id,doctor_id,transaction_id){
	//alert(amount+book_id+doctor_id+transaction_id)
	$.ajax({
			type:'POST',
			url:'payment-process.php',
			data:{amount:amount,ref:transaction_id,book_id:book_id,doctor_id:doctor_id},
			success:function(res){
				if (res.indexOf('success')>-1) {
				alert('Transaction successful reference is ' + transaction_id);
				
				window.location.assign("users/booking_list")
				console.log(res)
			}else{
				alert(res);
				$('#submit1').html("Book Now");

			}

			}
		})
}

$(document).on('click','#resend_verification',function(e){
		e.preventDefault();
		//get the attribute of form
		
		

		$('#resend_verification').html('<img src="img/small.gif"/>');
		$('#resend_verification').prop('disabled',true)
		$.ajax({
			type:'POST',
			url:"server/resend_verification.php",
			data:{"data":"data"},
			cache:false,
			success:function(res){
				if(res.indexOf("success") > -1)
				{
					
					alert("Verification mail has been sent to your email.");

					$('#resend_verification').html('Resend Verification');	
					$('#resend_verification').prop('disabled',false);
					
					
				}
				else{
					alert(res)
					
					//final_step();
					//$('#add_pricing').form[0].reset()
					$('#resend_verification').prop('disabled',false);
					$('#resend_verification').html('Resend Verification');	


				
				}
				
			}
		})
	})