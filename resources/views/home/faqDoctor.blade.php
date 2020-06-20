@extends('layouts.main')

@section('title')
<title>FAQ Doctors - Fokzmedics</title>
@endsection

@section('content')
	<div id="breadcrumb">
			<div class="container">
				<ul>
					<li><a href="index">Home</a></li>
					
					<li>FAQs DOCTORS</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_60 how-it-works-ul">
			<div class="row">
				
				<!--/aside -->
				
				<div class="col-lg-12" id="faq">
					<h4 class="nomargin_top">FAQs</h4>
					
					
				<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" href="#collapseAfo_payment" aria-expanded="false">
										<i class="indicator icon_plus_alt2"></i>How to use the system.
									</a>
								</h5>
							</div>
							<div id="collapseAfo_payment" class="collapse" role="tabpanel" data-parent="#payment">
								<div class="card-body">
<li>You are only activated to access patient traffic, after you pass through our verification process. We need to verify if you are truelly licensed to practice for this year in Nigeria.</li>
<li>You would go to “Upload License” fill out the fields and upload your current licence or evidence of licence renewal to prove that you are a physician licenced to practice in Nigeria.</li>
<li>It would take between 24 hours to 48 hours to verify your documents, afterward, your account would be activated.</li>
<li>After you have been activated, you can now start attending to patient's consultation traffic. </li>
<li>You can register a new patient and he/she would automatically be your refered patient by clicking “Register Patient”.After registering the new patient, and creating a prescription for him/her, they would be sent a mail to reset thier code. After changing thier code, they can now login to thier account and they would find the drug you prescribe in thier E-drug precription page.</li><br>
   <p>NOTE:When you refer a patient or client, you are entitled to a 1% commission of the cost of drug and 1% commission on the cost of lab test requested that the patient pays for on the system when he or she consults either a doctor or a pharmacist or yourself. This commission will be for as long as 5years. If you refer 10 patients daily for 30 days making it 180 patients your commission increases. Make it a goal to refer 10 patients daily.</p><br>
<h6>Lets take a quick tour through the buttons</h6>
<br>
<li>You can quickly access your profile page by clicking your profile picture.</li>

<li>The message icon is another avenue to see chat messages.</li>
<li>Set working schedule: this is were you manage your weekly consulting schedule for patients to book. Patients can not book you outside the time you are not available also, patients can not book you more than a week upfront so you can change your time table weekly to suit your schedule. A new week starts on sunday 00:00hrs.</li>
<li>View Appointment: This is were you view and manage patients appointments. This is were you also create drug prescription or request diagnostic investigation.</li>
<li>Purse: this is were you monitor your commissions and see your available balance.</li>
<li>Upload License: this is were you upload your present license and future license renewal.</li>

<li>What patients says: this is were you can view what your patients are saying about your service and you can also reply to each review.</li>
<li>My Profile: this is were you can edit your details.</li>

<h6>How to chat with patients.</h6>
<li><strong>View medical history:</strong> This is were you can access the patient medical history. When the button is clicked, all the drugs, lab test request that was prescribed for the patient by the doctor or pharmacist consulted in the past would be displayed here. Also the visit notes from doctors would be displayed here as well.</li>
 <li>You can start your chat in the conversation area by typing a message and sending it with the "send" button.</li>
 <li>When you are done with the consulatation, must fill your visit note or you would not be able to end the appointment. </li>
 <p>Note: you need to "flag as complete" and make the patient also confirm complete so we can confirm the consultation went well and your payment would then be processed immediately.</p>
 <li><strong>Request Test:</strong> when you click on the "Request Test" button, a form pops up. You type in the lab test you want for the patient, the system will bring up some predictions of name of test and their cost.<li><br>
 <li><strong>Doctor's comment:</strong> this is were you write your comment on the test you requested. You can add more test by clicking the "add test" button and when you are done, you can click "done".</li>
 <p>Note: when typing the test name, you must click on the predictions of names that displays, because it is the vital keyword the system will use to search out partners that offers such test. If you mis-spell a word or enter a word that the prediction did not display, the system would not  be able to search for a lab partner that does the test.</p>
 
<li>Rx prescription: when you click the "Rx prescription" button, a form pops up. On the prescription you will find the following fields;</li>
  
	<br>

<ul><strong> Drug name:</strong> This is where you type the name of  drug you want to prescribe. You can either input the trade name or generic name. When you start typing, you will see some predictions of the drug (with the quantity of the drug in a sachet or pack), you have in mind. You must select from the predictions the drug you want to prescribe. Do not mis-spell the drug or choose a drug different from the predictions because, it is what you input that the system would use to filter our pharmacy partner that has the drug.</ul>

<ul><strong>Strength/ Dose:</strong> This is were you input the strength of the drug you want to prescribed. The system would also predicte dose or strength of the drug for you and you must select from the predictions. You must enter the predicted strength of the drug you want to prescribe meaning the strength that can be found in different drug formularies for example if you want to prescribe a drug like cefuroxime suspension for a child weighing 10kg and the usual dose is 10mg/kg 12 hourly, what the child needs is 100mg, 12hourly for 5days. You know the available dose in the market is 125mg/5ml. What is expected of you to input in the dose is 125mg/5ml. Then at the provision for Doctor's comment you will write 100mg 12hourly for 5 days which is. 4mls 12hourly for 5 days. You are expected to calculate it for the patient. If you don't follow these steps, your patient wont be able to send drug to our pharmacy partners.</ul>

<ul><strong>Dosage form:</strong>
 This is were you input the dosage form, whether its a tablet, suspension, injection, syrup etc. The system will also predict the dosage form you have in mind, always select from the prediction.</ul>

<ul><strong>Frequency:</strong> This is were you write how many times in a day the patient is to take the drug. It could be: 8hourly or 12hourly or 24 hourly etc. Do not use the terms BID, TDS, OD QDS it is not allowed. The patients would understand the former better.</ul>

<ul><strong>Duration:</strong> This is were you write the number of days or weeks the patient is to take the drug for example 5days, 2weeks or 1month. Do not use 5/7 , 2/52 or 1/30.</ul>

<ul><strong>Quantity to be dispense:</strong> This is were you input the number of drug to be dispensed. The drug in the inventory are uploaded in unit quantity and the cost is per the unit. If you want to dispense a drug like "Artequin" which is a combination of Mefloquin and artesunate and you know they are separate drugs but you count each individual drug as a unit so that the quantity to be dispensed is 6 tablets. When typing the name of the drug, the system displayed to you the quantity in a pack or a sachet. You would input your quantity in the multiple of that figure. For example, Teva Amlodipine contains 28 tablets, its would be wrong to input 13 tablets or 30 tablets or even 40. But 28, 56 and 84 would be the correct figures.</ul>

<ul><strong>Doctor's comment:</strong> This is were you write every single instruction and description on how to take the drug for the patient.</ul>

<ul>There is a button called "add drug". When clicked would save the drug and its parameters then another button called "add more", were you can add more drugs to the prescription. When you are done, you click on "Done". On the chat detail page, you can see all the drugs you precribed and an edit button were you can edit a particular drug if you made a mistake.</ul>							
		<br>					<br>
	<p><strong>NOTE:</strong> The key parameters for every prescription are: "Drug name", "Strength", and "Dosage form", you must select from the predictions the system provides, so the patient can send the drug to our partner pharmacy.</p>	
	
	<h6> Some examples of prescription and how to fill them.</h6>
	<li>Drugs that contains 1-3 active ingredients: This are drugs that contains 1-3 active ingredients.</li>	
<br>
<p><strong>Instances</strong></p>

<ul>Paracetamol Syrup: You fill the fields as shown below

<li>Drug: Acetaminophen</li>
<li>Strength: 125mg/5ml</li>
<li>Dosage Form: Syrup</li>
<li>Frequency:8hourly</li>
<li>Duration: 3days</li>
<li>Quantity to be dispensed: 1</li>
<li>Doctor's Comment: Don't exceed 3days</li>
</ul>



<ul>Paracetamol Tablet: You fill the fields as shown below

<li>Drug: Acetaminophen</li>
<li>Strength: 500mg</li>
<li>Dosage Form: Tablet</li>
<li>Frequency:8hourly</li>
<li>Duration: 3days</li>
<li>Quantity to be dispensed: 18</li>
<li>Doctor's Comment: Take 2 tablets 8hourly for 3 days.</li>
</ul>



<ul>Coveram Tablet: You fill the fields as shown below
<li>Drug: Peridopril, Amlodipine</li>
<li>Strength: 5mg/5mg</li>
<li>Dosage Form: Tablet</li>
<li>Frequency:24 hourly</li>
<li>Duration: 30 days</li>
<li>Quantity to be dispensed: 30</li>
<li>Doctor's Comment: your comment.</li>
</ul>


<ul>Elicorid Tablet: You fill the fields as shown below

<li>Drug: Rabeprazole, Clarithromycin, Amoxicillin</li>
<li>Strength: 20mg/500mg/1000mg</li>
<li>Dosage Form: Tablet</li>
<li>Frequency:12 hourly</li>
<li>Duration: 14 days</li>
<li>Quantity to be dispensed: 84</li>
<li>Doctor's Comment: your comment.</li>
</ul>

<ul>Ventolin Inhaler: You fill the fields as shown below

<li>Drug: Salbutamol sulphate</li>
<li>Strength:100mcg</li>
<li>Dosage Form: Aerosol</li>
<li>Frequency:12 hourly</li>
<li>Duration: 14 days</li>
<li>Quantity to be dispensed:1</li>
<li>Doctor's Comment: your comment.</li>
</ul>

<ul>Gentamycin Injection: You fill the fields as shown below

<li>Drug: Gentamycin Injection</li>
<li>Strength:80mg/2ml</li>
<li>Dosage Form: Injectible</li>
<li>Frequency:24 hourly</li>
<li>Duration: 3 days</li>
<li>Quantity to be dispensed:3</li>
<li>Doctor's Comment: your comment.</li>
</ul>
<br>
<p>Note: When prescribing an injectible, you also prescribe syringes and extra needles.</p>

<br>

<li>Drugs that contains 4 - and above active ingredients, creams, lotions, gel: These are drugs  that contains 4 - and above active ingredients and creams, lotions and gel.</li>


<ul>Lofnac Gel: You fill the fields as shown below

<li>Drug: Lofnac Gel</li>
<li>Strength:Other</li>
<li>Dosage Form: Gel</li>
<li>Frequency:8 hourly</li>
<li>Duration: 14 days</li>
<li>Quantity to be dispensed:2</li>
<li>Doctor's Comment: your comment.</li>
</ul>


<ul>K-Y Jelly: You fill the fields as shown below

<li>Drug: K-Y Jelly</li>
<li>Strength:Other</li>
<li>Dosage Form: Gel</li>
<li>Frequency:Use as needed</li>
<li>Duration: Use as needed</li>
<li>Quantity to be dispensed:1</li>
<li>Doctor's Comment: your comment.</li>
</ul>

<ul>Candid Powder: You fill the fields as shown below

<li>Drug: Candid Powder</li>
<li>Strength:Other</li>
<li>Dosage Form: Powder</li>
<li>Frequency:Use as needed</li>
<li>Duration: Use as needed</li>
<li>Quantity to be dispensed:1</li>
<li>Doctor's Comment: your comment.</li>
</ul>


<ul>Pronatal: You fill the fields as shown below

<li>Drug: Pronatal</li>
<li>Strength:Other</li>
<li>Dosage Form: Tablet</li>
<li>Frequency:12 hourly</li>
<li>Duration: 30days</li>
<li>Quantity to be dispensed:30</li>
<li>Doctor's Comment: your comment.</li>
</ul>




<li>Consumables</li>	

<ul>Syringes: You fill the fields as shown below

<li>Drug: Syringes</li>
<li>Strength:5ml</li>
<li>Dosage Form: Other</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Doctor's Comment: your comment.</li>
</ul>


<ul>Hydrogen peroxide: You fill the fields as shown below

<li>Drug: Hydrogen peroxide</li>
<li>Strength:200ml</li>
<li>Dosage Form: Other</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Doctor's Comment: your comment.</li>
</ul>






<ul>Lydia IUCD: You fill the fields as shown below

<li>Drug: IUCD Copper T Cu 380A</li>
<li>Strength:Other</li>
<li>Dosage Form: Other</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Doctor's Comment: your comment.</li>
</ul>

<ul>Infusions: You fill the fields as shown below

<li>Drug: 5% Dextrose saline</li>
<li>Strength:500ml</li>
<li>Dosage Form: Infusions</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Doctor's Comment: your comment.</li>
</ul>



								</div>
							</div>
						</div>	
					
					<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" href="#collapseAfoz_payment" aria-expanded="false">
										<i class="indicator icon_plus_alt2"></i>Benefits of using fokzmedics.
									</a>
								</h5>
							</div>
							<div id="collapseAfoz_payment" class="collapse" role="tabpanel" data-parent="#payment">
								<div class="card-body">
								    
								    
<p>Since the advent of the internet,  just like in the dawn of the industrial revolution, the way of doing things from the simple sending of mail from one point to another has seen a tremendous and drastic transformation from mail carriers to electronic transfer of mail called email through the internet. That is just an iota of the transformation of the way we do things from regular task to business oriented task. The internet has transformed so many sectors of human endeavour, from transportation, to communication to mass media etc. The health sector would not be left behind. There are so many advantages that the internet makes available for transforming the health sector, to make healthcare services and logistics simpler, transparent, convinient, scalable, easily accessible and create boundless opportunities for both the healthcare providers and the clients.</p><br>
<p>Before we continue let us highlight some of the problems currently prevailing in our traditional way of healthcare provision in Nigeria.</p><br>
<li><strong>Inadequate medical centres or institutions: </strong>There are few hospital, clinics, primary health centres, pharmacies, diagnostic centres. To satisfy the 190 million and growing population of Nigeria. Nigeria is projected to be the world’s third most populous country by the year 2050, according to a report released by the UN Department of Economic and Social Affairs. Sadly, fewer hospitals are being established which would not commensurate the rapid population growth. Shortage of health centres has led to increase in unemployment among doctor.</li><br>
<li><strong>High cost in opening a medical facility:</strong> the cost for a young doctor starting his own clinic is expensive, if he doesn't have investors he might have to work for years to save up because of poor remuneration before setting up his own clinic.</li>
<li><strong>Poor remuneration:</strong> As stated earlier, this is one of the major problems facing medical care providers. Compare to developed countries, where their counterparts are paid well, here in Nigeria, Government owned hospitals usually pay higher than private hospitals. Still the payment is small and plagued by periodic strike actions. Some of our medical counterparts have had to escape this conundrum by going overseas to practice where they can be duly paid for their service</li>
<li><strong>Poor patient medical records management:</strong> one of the heartaches of doctors, when they consult with their patients, is poor medical record and drug prescription history, coupled with the fact that the doctor has hundreds of patients on queue to see him, and no enough time to clerk patients. Making proper decisions backed by accurate medical history provision to an extent is hampered.</li>
<li><strong>Poor medical utility inventory:</strong> this is another plague which never seem to have an end in sight. This has resulted to the uncertainty that your patient would get the right quality of drug, which have usually led to relapse for some disease being treated.</li>

<li><strong>Poor access to qualified medical practitioners especially in the sub-urban:</strong> Most qualified doctors are concentrated in the metropolitan cities like abuja, lagos etc. Patients in the sub urban and villages can not access them.</li>

<li><strong>Poor understanding of prescription directive that most times leads to poor adherence of drug:</strong> Most times, the patient does not really understand the direction of how to take their drugs.</li>
 
<p>These are a few among the many other problems doctors face in their practice in nigeria.</p><br>
<h6>Fokzmedics solutions and benefits to you.</h6>
<li>We offer you your personal  virtual clinic right at your finger tip. Fokzmedics seeks to solves the above problems and much more. Making you have a very convinient, flexble and lucrative practice while you become your own boss and possibly raise capital to finance your dream of a well equiped medical facility and others.</li>
<li>with our online platform, you do not need to connect with patient through the traditional hospitals alone. You can easily build your profile online by attending to millions of Nigerians within your city and beyond using our flexible tools like, live chatting with a patient, online booking management,offering home service Or they pay you a visit in your office.</li>

	<li> You get to list your own consultation fee.</li>
	<li> You can easily access patient's medical and drug history to help in your treatment plan</li>
	<li>You can be sure of the quality of the  drugs you prescribe since we partner with only professional pharmacy stores.</li>
<li>Be your own boss.</li>
<li>No overhead cost: You longer need to bother about payment of  salary for staff. Our smart secretary will manage your appointments.</li>
<li>Asides your consultation fee, you get paid for every drug you prescribed and lab test investigation you request for every patient attended to. Which is indirectly the mark up on drugs and lab test you will make from owning a clinic, you would still get without having any drug inventory or any lab equipments that are usually expensive. No out of stock on drugs, no expiration of drugs, no staff to manage inventory etc.</li>
<li>You are not restricted to patients within your locality alone. You can chat with patients all over Nigeria and still get paid for any drug or lab test you requested.</li>
<li>Easily build your reputation that Nigerians can easily access by getting positive reviews and star rating from patient you have attended to.</li>
<li>You can easily start your career from the scratch by choosing to be a Home/office visiting doctor.</li>
<li>Achieve your dreams in your profession by easily raising funds from scratch. No need to search for investors for that your idea.</li>
<p>You have access to rich retinue on patient history that would aid your decision making in treatment plan.</li>
<li>You can choose to work whenever you want and where ever you want. </li>
<li>You can manage your appointment weekly according to your timetable or plan for the week.</li> 
<li>You get commission from every patient or doctor or pharmacist you refer for not less than 365 days</li>
 <li>You can easily relocate to any city and access your account from anywhere in the world with your patient base still intact</li>
<li>For home visiting doctors, easily plan your visit route by declining any patient far from you.</li>

<br><br>


								</div>
							</div>
						</div>	
					
				
			
	<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" href="#collapseFoz_payment" aria-expanded="false">
										<i class="indicator icon_plus_alt2"></i>Terms of use
									</a>
								</h5>
							</div>
							<div id="collapseFoz_payment" class="collapse" role="tabpanel" data-parent="#payment">
								<div class="card-body">
									<p>
<li>Keep your login details very private. Nobody else should be able to prescribe drugs with your account.  </li>
<li>When it is beyond you always refer to a specialist</li>
<li>Don't prescribe drug when it is not necessary, patients can consider you too expensive and easily abandon prescription</li>
<li>Upload a profile picture of you in your ward coat</li>


<li>Give your patients time to lay all their complaints don't be hasty to consult with the next patient</li>
<li>Know, it is not all conversation that would lead to prescription when a simple advice would do. Build your reputation</li>
<li>Before prescribing narrow spectrum antibiotics always request for a lab test except for broad spectrum antibiotics.</li>
<li> Always write a comprehensive visit notes that other doctors can understand.</li>
<li>Always read the patient history.</li>

<li>Encourage your patient to purchase prescription. Read our value offers to patient so you can have points to use in encouraging them</li>

<li>If you speak any other language you can signify</li>

<li>Build your reputation by attracting positive reviews from patients</li>

<li>Advertise your page on the various social media platform</li>

<li>Carry the patient along, in your treatment plan</li>
</p>

								</div>
							</div>
						</div>


	
						
									
									
	
									
							
				
					
				
								</div>
							

				</div>
				<!-- /col -->
			</div>
			<!-- /row -->
		
		
		
@endsection


@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
@endsection

@section('script')
{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    flatpickr('#time_input',{
  		enableTime:true,
  		enableSeconds:true,
  		noCalendar: true,
	});
</script> --}}
@endsection