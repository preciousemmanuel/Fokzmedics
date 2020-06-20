@extends('layouts.main')

@section('title')
<title>Faq Freelance - Fokzmedics</title>
@endsection

@section('content')
	<div id="breadcrumb">
			<div class="container">
				<ul>
					<li><a href="/">Home</a></li>
					
					<li>FAQs</li>
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
<li>You would go to “Upload License” fill out the fields and upload your current licence or evidence of licence renewal from PCN  to prove that you are a pharmacist licenced to practice in Nigeria.</li>
<li>It would take between 24 hours to 48 hours to verify your documents, afterward, your account would be activated.</li>
<li>After you have been activated, you can now start attending to patient's consultation traffic. </li>
<li>You can register a new patient and he/she would automatically be your refered patient by clicking “Register Patient”.</li><br>
   <p>NOTE:When you refer a patient, you are entitled to a 2% commission of the cost of drug and 2% commission on the cost of lab test requested that the patient pays for on the system when he or she consults either a doctor or a fellow pharmacist or yourself. This commission will be for as long as 5years. If you refer 10 patients daily for 30 days making it 180 patients your commission increases. Make it a goal to refer 10 patients daily.</p><br>
<h6>Lets take a quick tour through the buttons</h6>

<li>You can quickly access your profile page by clicking your profile picture.</li>
<li>The bell button is were you can see new chat alerts from patients. When you get a chat alert, a yellow notification icon displays close to the bell.</li>
<li>The message icon is another avenue to see chat messages.</li>
<li>Chat log: this is were you can see the log of patients you consulted.</li>
<li>Purse: this is were you monitor your commissions and see your available balance.</li>
<li>Upload License: this is were you upload your present license and future license renewal.</li>

<li>What patients says: this is were you can view what your patients are saying about your service and you can also reply to each review.</li>
<li>My Profile: this is were you can edit your details.</li>

<h6>How to chat with patients.</h6>
<li><strong>View medical history:</strong> This is were you can access the patient medical history. When the button is clicked, all the drugs, lab test request that was prescribed for the patient by the doctor or pharmacist consulted in the past would be displayed here. Also the visit notes from doctors would be displayed here as well.</li>
 <li>You can start your chat in the conversation area by typing a message and sending it with the "send" button.</li>
 <li><strong>Lab test:</strong> when you click on the "lab test" button, a form pops up. You type in the lab test you want for the patient the system will bring up some predictions of name of test and their cost</li><br>
 <li><strong>Pharmacist comment:</strong> this is were you write your comment on the test you requested. You can add more test by clicking the "add test" button and when you are done, you can click "done".</li>
 <p>Note: when typing the test name, you must click on the predictions of names that displays, because it is the vital keyword the system will use to search out partners that offers such test. If you mis-spell a word or enter a word that the prediction did not display, the system would not  be able to search for a lab partner that does the test.</p>
 
<li>Drug prescription: when you click the "drug" button, a form pops up. On the prescription you will find the following fields;</li>
  
								
	<br>

<ul><strong> Drug name:</strong> This is where you type the name of  drug you want to prescribe. You can either input the trade name or generic name. When you start typing, you will see some predictions of the drug (with the quantity of the drug in a sachet or pack), you have in mind. You must select from the predictions the drug you want to prescribe. Do not mis-spell the drug or choose a drug different from the predictions because, it is what you input that the system would use to filter our pharmacy partner that has the drug.</ul>

<ul><strong>Strength/ Dose:</strong> This is were you input the strength of the drug you want to prescribed. The system would also predicte dose or strength of the drug for you and you must select from the predictions. You must enter the predicted strength of the drug you want to prescribe meaning the strength that can be found in different drug formularies for example if you want to prescribe a drug like cefuroxime suspension for a child weighing 10kg and the usual dose is 10mg/kg 12 hourly, what the child needs is 100mg, 12hourly for 5days. You know the available dose in the market is 125mg/5ml. What is expected of you to input in the dose is 125mg/5ml. Then at the provision for pharmacist comment you will write 100mg 12hourly for 5 days which is. 4mls 12hourly for 5 days. You are expected to calculate it for the patient. If you don't follow these steps, your patient wont be able to send drug to our pharmacy partners.</ul>

<ul><strong>Dosage form:</strong>
 This is were you input the dosage form, whether its a tablet, suspension, injection, syrup etc. The system will also predict the dosage form you have in mind, always select from the prediction.</ul>

<ul><strong>Frequency:</strong> This is were you write how many times in a day the patient is to take the drug. It could be: 8hourly or 12hourly or 24 hourly etc. Do not use the terms BID, TDS, OD QDS it is not allowed. The patients would understand the former better.</ul>

<ul><strong>Duration:</strong> This is were you write the number of days or weeks the patient is to take the drug for example 5days, 2weeks or 1month. Do not use 5/7 , 2/52 or 1/30.</ul>

<ul><strong>Quantity to be dispense:</strong> This is were you input the number of drug to be dispensed. The drug in the inventory are uploaded in unit quantity and the cost is per the unit. If you want to dispense a drug like "Artequin" which is a combination of Mefloquin and artesunate and you know they are separate drugs but you count each individual drug as a unit so that the quantity to be dispensed is 6 tablets. When typing the name of the drug, the system displayed to you the quantity in a pack or a sachet. You would input your quantity in the multiple of that figure. For example, Teva Amlodipine contains 28 tablets, its would be wrong to insert 13 tablets or 30 tablets or even 40. But 28, 56 and 84 would be the correct figures.</ul>

<ul><strong>Pharmacist comment:</strong> This is were you write every single instruction and description on how to take the drug for the patient.</ul>

<ul>There is a button called "add drug". When clicked would save the drug and its parameters then another button called "add more", were you can add more drugs to the prescription. When you are done, you click on "Done". On the chat detail page, you can see all the drugs you precribed and an edit button were you can edit a particular drug if you made a mistake.</ul>							
		<br>					<br>
	<p><strong>NOTE:</strong> The key parameters for every prescription are: "Drug name", "Strength", and "Dosage form", you must select from the predictions the system provides, so the patient can send the drug to our partner pharmacy.</p>	
	<p> You can also create a prescription for patients that wants to refill thier medications like BP and diabetic patients.</p>						<br>
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
<li>Pharmacist's Comment: Don't exceed 3days</li>
</ul>



<ul>Paracetamol Tablet: You fill the fields as shown below

<li>Drug: Acetaminophen</li>
<li>Strength: 500mg</li>
<li>Dosage Form: Tablet</li>
<li>Frequency:8hourly</li>
<li>Duration: 3days</li>
<li>Quantity to be dispensed: 18</li>
<li>Pharmacist's Comment: Take 2 tablets daily for 3 days.</li>
</ul>



<ul>Coveram Tablet: You fill the fields as shown below
<li>Drug: Peridopril, Amlodipine</li>
<li>Strength: 5mg/5mg</li>
<li>Dosage Form: Tablet</li>
<li>Frequency:24 hourly</li>
<li>Duration: 30 days</li>
<li>Quantity to be dispensed: 30</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>


<ul>Elicorid Tablet: You fill the fields as shown below

<li>Drug: Rabeprazole, Clarithromycin, Amoxicillin</li>
<li>Strength: 20mg/500mg/1000mg</li>
<li>Dosage Form: Tablet</li>
<li>Frequency:12 hourly</li>
<li>Duration: 14 days</li>
<li>Quantity to be dispensed: 84</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>

<ul>Ventolin Inhaler: You fill the fields as shown below

<li>Drug: Salbutamol sulphate</li>
<li>Strength:100mcg</li>
<li>Dosage Form: Aerosol</li>
<li>Frequency:12 hourly</li>
<li>Duration: 14 days</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>

<ul>Gentamycin Injection: You fill the fields as shown below

<li>Drug: Gentamycin Injection</li>
<li>Strength:80mg/2ml</li>
<li>Dosage Form: Injectible</li>
<li>Frequency:24 hourly</li>
<li>Duration: 3 days</li>
<li>Quantity to be dispensed:3</li>
<li>Pharmacist's Comment: your comment.</li>
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
<li>Pharmacist's Comment: your comment.</li>
</ul>


<ul>K-Y Jelly: You fill the fields as shown below

<li>Drug: K-Y Jelly</li>
<li>Strength:Other</li>
<li>Dosage Form: Gel</li>
<li>Frequency:Use as needed</li>
<li>Duration: Use as needed</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>

<ul>Candid Powder: You fill the fields as shown below

<li>Drug: Candid Powder</li>
<li>Strength:Other</li>
<li>Dosage Form: Powder</li>
<li>Frequency:Use as needed</li>
<li>Duration: Use as needed</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>


<ul>Pronatal: You fill the fields as shown below

<li>Drug: Pronatal</li>
<li>Strength:Other</li>
<li>Dosage Form: Tablet</li>
<li>Frequency:12 hourly</li>
<li>Duration: 30days</li>
<li>Quantity to be dispensed:30</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>




<li>Consumables, diapers, medical gadget</li>	

<ul>Syringes: You fill the fields as shown below

<li>Drug: Syringes</li>
<li>Strength:5ml</li>
<li>Dosage Form: Other</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>


<ul>Hydrogen peroxide: You fill the fields as shown below

<li>Drug: Hydrogen peroxide</li>
<li>Strength:200ml</li>
<li>Dosage Form: Other</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>



<ul>Purit: You fill the fields as shown below

<li>Drug: Purit</li>
<li>Strength:4L</li>
<li>Dosage Form: Other</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>

<ul>Maxcare diapers: You fill the fields as shown below

<li>Drug: Maxcare diapers</li>
<li>Strength:Large</li>
<li>Dosage Form: Other</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>


<ul>Lydia IUCD: You fill the fields as shown below

<li>Drug: IUCD Copper T Cu 380A</li>
<li>Strength:Other</li>
<li>Dosage Form: Other</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>

<ul>Infusions: You fill the fields as shown below

<li>Drug: 5% Dextrose saline</li>
<li>Strength:500ml</li>
<li>Dosage Form: Infusions</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
</ul>



<ul>Blood Pressure Monitor: You fill the fields as shown below

<li>Drug: Omron MIT Elite Blood Pressure Monitor</li>
<li>Strength:other</li>
<li>Dosage Form: other</li>
<li>Frequency:Other</li>
<li>Duration: Other</li>
<li>Quantity to be dispensed:1</li>
<li>Pharmacist's Comment: your comment.</li>
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
										<li>You get paid for every drug and lab test you prescribe for every patient consulted. No staff overhead cost, no inventory, no expiration of drug.</li>
<li>Achieve your dreams in your profession by easily raising funds from scratch. No need to search for investors for that idea of yours. Is it a pharmacy store, or you want to go into importation or manufacturing of drugs. </li>
<li>You can easily migrate to become a pharmacy partner.(Just contact Admin) </li>
<li>Easily build your reputation that Nigerians can easily access by getting positive reviews and star rating from patients you attended to.</li>
<li>You are no longer restrained within the wall of a pharmacy you now have access to 109 million nigerians according to NCC that uses the internet</li>
<li>You can connect with the over 26 million facebook users in Nigeria, by connecting your fokzmedics page url to your facebook page account and other social media account</li>

<li>As far as your licence is up to date, you can consult from anywhere in the world. What we call “working on the go!”</li>

<li>Be your own boss and work at your convenience.</li>
<li>Get commission everyday for at least to 365 days when you refer patients, other pharmacists,  partner pharmacies, medical laboratories and a doctors.</li>
<li>Boost your professional reputation for Nigerians to see.</li>
<li>And much more...</li>
<br>
<p><strong>Note:</strong> If you want to boost your facebook page that is connected to your fokzmedics page, you can get social media experts on any of the following freelance site:</p>
<li>www.fiverr.com</li>
<li>www.oyerr.com</li>
<li>www.upwork.com</li>
<li>www.freelance.com</li>
<br><br>


								</div>
							</div>
						</div>	
					
				
			
	<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" href="#collapseFoz_payment" aria-expanded="false">
										<i class="indicator icon_plus_alt2"></i>Terms of Use
									</a>
								</h5>
							</div>
							<div id="collapseFoz_payment" class="collapse" role="tabpanel" data-parent="#payment">
								<div class="card-body">
									<p>
<li>Try and stick to one category - the categorization is more of age demographic than clinical</li>
<li>When it is beyond you always refer to a specialist</li>
<li>Don't prescribe drug when it is not necessary, patients can consider you too expensive and easily abandon prescription</li>
<li>Upload a profile picture of you wearing your ward coat</li>

<li>Always introduce yourself first</li>
<li>Know your drugs. You can use various health websites during chat like medscape etc</li>
<li>Give your patients time to lay all their complaints don't be hasty to chat with the next patient</li>
<li>Know, it is not all conversation that would lead to prescription when a simple advice would do. Build your reputation</li>
<li>Before prescribing antibiotics always request for a lab test</li>
<li>You are restricted as a pharmacist on the kind of test you can request for. kind of test you can request are: FULL Blood count, MP test, widal, urinalysis, stool culture, swab test. Requesting for test order than these, you would not benefit any commission</li>
<li>Always read the patient history.</li>
<li>Do not use slangs, or wrong spellings. Always spell out your words completely</li>
<li>Encourage your patient to purchase prescription.</li>
<li>Don't refer a patient to a particular pharmacy. We strive to ensure equal opportunities to our pharmacy partners.</li>
<li>If you speak any other language you can signify</li>

<li>Advertise your page on the various social media platform</li>

<li>Carry the patient along, in your treatment plan</li>
<li>You are not allowed to prescribe any controlled drug. If you do, you would not get any commission for it always refer the patient to the doctor. </li>
<br>

Class of drugs and prohibited for Pharmacist to prescribe
	<ul>Opioid Analgesics</ul>
	<ul>Narcotics</ul>
<ul>Benzodiazepines</ul>
	<ul>Barbiturates</ul>
	<ul>Misoprostol</ul>
	<ul>Anticancer drugs</ul>
	<ul>Contraceptives drugs(you can prescribe the device)</ul>
	<ul>Litium salts</ul>
	<ul>Amphetamines</ul>
	<ul>Cocaine</ul>
	<ul>Ecstasy</ul>
	<ul>Mifepristone</ul>
	<ul>Oxytocin</ul>
	<ul>Ergometrine  Maleate</ul>
	<ul>Levonogestrel</ul>
	<ul>Drugs for erectile dysfunction</ul>
	<ul>Anesthetic Drugs</ul>

<h6>As time goes on we would update this list, endeavour to check it periodically.</h6>


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