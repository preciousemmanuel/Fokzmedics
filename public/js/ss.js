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
					//alert(patient_email)
				alert("Booking successfull! You are almost done; Pay the doctor's consultancy fee to finish booking process.");

					// $('#submit1').html('Book Now');	
					//$('#submit1').prop('disabled',false);
					//sessionStorage.clear();
					
					$('#login-modal').modal('hide');
					//$('#pay-modal').modal('show');
					payment_booking(patient_email,amount,book_id,doctor)
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
					
					alert("Oops!!! Sorry the date and time must not be less than current date.Try again by choosing another date or time ");

					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
					sessionStorage.clear()
					
				}else if (data.status=="error") {
					alert(data.msg)
					$('#submit1').html('Book Now');	
					$('#submit1').prop('disabled',false);
				}