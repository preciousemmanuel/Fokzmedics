<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home.index');
// });

// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');




Route::get('/','WelcomeController@index')->name('index');


Route::get('/about','WelcomeController@about')->name('home.about');
Route::get('/how-it-works','WelcomeController@howWork')->name('home.howWork');
Route::get('/faq','WelcomeController@faq')->name('home.faq');
Route::get('/faq-doctors','WelcomeController@faqDoctor')->name('home.faqDoctor');
Route::get('/faq-freelance','WelcomeController@faqFreelance')->name('home.faqFreelance');
Route::get('/return-policy','WelcomeController@returnPolicy')->name('home.returnPolicy');
Route::get('/disclaimer','WelcomeController@disclaimer')->name('home.disclaimer');
Route::get('/terms-condition','WelcomeController@termsCondition');
Route::get('/privacy-policy','WelcomeController@privacyPolicy');

Route::post('/search_doctors','WelcomeController@searchDoctor')->name('autocomplete_search');
Route::post('/search_drug','WelcomeController@searchDrug')->name('autocomplete_search_drug');
Route::post('/search_test','WelcomeController@searchTest')->name('autocomplete_search_test');
//this route is to view each doctor profile
Route::get('/practitioner/{user}','WelcomeController@getPractitioner')->name('viewPractitioner');
Route::get('/freelancers/{freelancercategory}','WelcomeController@listFreelancers')->name('listFreelancers');
Route::get('/freelancers','WelcomeController@allFreelancers')->name('allFreelancers');
Route::get('/doctors','WelcomeController@doctors')->name('doctors');
Route::get('/doctors/{specialization}','WelcomeController@doctorSpecializations')->name('home.specialization');
Route::post('city-by-state','HomeController@getCity')->name('home.getCity');

Auth::routes(['verify'=>true]);

//this is route for social auth
Route::get('/redirect/{provider}','Auth\LoginController@redirectToProvider')->where(['provider' => 'facebook|google|twitter'])->name('redirect');
Route::get('/callback/{provider}','Auth\LoginController@handleProviderCallback')->where(['provider' => 'facebook|google|twitter']);

Route::get('/home', 'HomeController@index')->name('home');
Route::put('user/{user}/update-user-type','HomeController@updateUserType')->name('updateUserType');




// Route::get('test', function () {
//     event(new App\Events\NewMessage('Someone'));
//     return "Event has been sent!";
// });

// Route::get('test-view', function () {
//     return view('test');
// });

Route::middleware(['auth','verified'])->group(function(){

	Route::post('doctor/book/{book}/sendChat','DoctorController@sendChat')->name('doctor.sendChat');
	Route::post('patient/book/{book}/sendChat','PatientController@sendChat')->name('patient.sendChat');

	Route::get('doctor/profile','DoctorController@profile')->name('doctor.profile');
	Route::get('doctor/licence','DoctorController@licence')->name('doctor.licence');
	Route::put('doctor/{user}/profile','DoctorController@updateProfile')->name('doctor.update-profile');
	Route::put('doctor/{user}/upload-licence','DoctorController@uploadLicence')->name('doctor.upload-licence');
	Route::post('doctor/{user}/delete-licence','DoctorController@deleteLicence')->name('doctor.delete-licence');
	Route::get('doctor/schedule','DoctorController@showSchedule')->name('doctor.schedule');
	Route::post('doctor/schedule','DoctorController@createSchedule')->name('doctor.create-schedule');
	Route::get('doctor/schedule/{schedule}/edit-schedule','DoctorController@editSchedule')->name('doctor.edit-schedule');
	Route::put('doctor/schedule/{schedule}/update-schedule','DoctorController@updateSchedule')->name('doctor.update-schedule');
	Route::get('doctor/bookings','DoctorController@bookingList')->name('doctor.bookings');
	Route::get('doctor/{book}/booking','DoctorController@showBooking')->name('doctor.showBooking');
	Route::post('doctor/sendDrug/{book}','DoctorController@sendDrug')->name('doctor.sendDrug');
	Route::post('doctor/sendTest/{book}','DoctorController@sendTest')->name('doctor.sendTest');
	Route::get('doctor/drugs/{book}','DoctorController@listDrugs')->name('doctor.listDrugs');
	Route::put('doctor/sendExtra/{book}','DoctorController@sendExtra')->name('doctor.sendExtra');
	Route::post('doctor/complet-book','DoctorController@markBookComplete')->name('doctor.markComplete');
	Route::get('doctor/register-patient','DoctorController@register')->name('doctor.register');
	Route::post('doctor/add-patient','DoctorController@addPatient')->name('doctor.addPatient');
	Route::post('doctor/start-book','DoctorController@startBook')->name('doctor.startBook');
	Route::get('doctor/reviews','DoctorController@reviews')->name('doctor.reviews');

	Route::get('patient/profile','PatientController@profile')->name('patient.profile');
	Route::put('patient/{user}/profile','PatientController@updateProfile')->name('patient.update-profile');
	Route::post('patient/{user}/book','PatientController@bookDoctor')->name('patient.bookDoctor');
	Route::post('patient/{user}/payOnDelivery','PatientController@payOnDelivery')->name('patient.payOnDelivery');
	Route::get('patient/payment/book','PatientController@showBookingPayment')->name('patient.showPaymentBooking');
	Route::post('patient/payment/{book}/store','PatientController@storeBookingPayment')->name('patient.storeBookingPayment');
	Route::post('patient/payment/{book}/drug','PatientController@saveDrugTransaction')->name('patient.saveDrugTransaction');
	Route::post('patient/payment/{book}/test','PatientController@saveTestTransaction')->name('patient.saveTestTransaction');
	Route::get('patient/success/book','PatientController@bookingSuccess')->name('patient.showBookingSuccess');
	Route::get('patient/bookings','PatientController@bookingList')->name('patient.bookings');
	Route::get('patient/{book}/booking','PatientController@showBooking')->name('patient.showBooking');
	Route::get('patient/automated-drug-prescription','PatientController@automatedDrugs')->name('patient.automatedDrugs');
	Route::get('patient/automated-test-prescription','PatientController@automatedTest')->name('patient.automatedTest');
	Route::get('patient/drug-upload','PatientController@drugUpload')->name('patient.drugUpload');
	Route::post('patient/drug-upload','PatientController@saveDrugUpload')->name('patient.saveDrugUpload');
	Route::post('patient/drug-upload','PatientController@saveDrugUpload')->name('patient.saveDrugUpload');
	Route::get('patient/store/{book}','PatientController@pharmacyList')->name('patient.drugStore');
	Route::get('patient/all-pharmacies/{book}','PatientController@pharmacyAllList')->name('patient.allPharmacies');
	Route::get('patient/lab/{book}','PatientController@labList')->name('patient.labStore');
	Route::get('patient/store/pharmacy/{user}/book/{book}','PatientController@buyDrugs')->name('patient.buyDrugs');
	Route::get('patient/store/lab/{user}/book/{book}','PatientController@payTest')->name('patient.payTest');
	Route::get('patient/drug-transaction','PatientController@drugTransaction')->name('patient.drugTransaction');
	Route::get('patient/test-transaction','PatientController@testTransaction')->name('patient.testTransaction');
	Route::post('patient/mark-recieved','PatientController@markRecieved')->name('patient.markRecieved');
	Route::post('patient/mark-test-recieved','PatientController@markTestRecieved')->name('patient.markTestRecieved');
	Route::put('patient/drug-complain','PatientController@drugComplain')->name('patient.drugComplain');
	Route::put('patient/test-complain','PatientController@testComplain')->name('patient.testComplain');
	Route::get('patient/transaction-success','PatientController@transactionSuccess')->name('patient.showTransactionSuccess');
	Route::get('patient/purse','PatientController@purse')->name('patient.purse');
	Route::get('patient/{user}/chat-request','PatientController@chatRequest')->name('patient.chatRequest');
	Route::get('patient/chat-history','PatientController@chatHistory')->name('patient.chatHistory');
	Route::get('patient/{grant}/show-list','PatientController@showFreelanceChat')->name('patient.showFreelanceChat');
	Route::get('patient/{user}/chat-request','PatientController@chatRequest')->name('patient.chatRequest');



	Route::get('pharmacy/profile','PharmacistController@profile')->name('pharmacy.profile');
	Route::put('pharmacy/{user}/profile','PharmacistController@updateProfile')->name('pharmacy.update-profile');
	Route::get('pharmacy/licence','PharmacistController@licence')->name('pharmacy.licence');
	Route::put('pharmacy/{user}/upload-licence','PharmacistController@uploadLicence')->name('pharmacy.upload-licence');
	Route::post('pharmacy/{user}/delete-licence','PharmacistController@deleteLicence')->name('pharmacy.delete-licence');
	Route::get('pharmacy/drugs','PharmacistController@showDrugs')->name('pharmacy.drugs');
	Route::get('pharmacy/central-drugs','PharmacistController@centralDrug')->name('pharmacy.centralDrug');
	Route::post('pharmacy/drug/{user}','PharmacistController@storeDrug')->name('pharmacy.storeDrug');
	Route::put('pharmacy/drug/{drug}','PharmacistController@updateDrug')->name('pharmacy.updateDrug');
	Route::get('pharmacy/import-drug','PharmacistController@importExcel')->name('pharmacy.importExcel');
	Route::get('pharmacy/transaction','PharmacistController@drugTransaction')->name('pharmacy.drugTransaction');
	Route::post('pharmacy/upload-drug','PharmacistController@excelDrugUpload')->name('pharmacy.excelDrugUpload');
	Route::post('pharmacy/move-drugs','PharmacistController@moveDrugs')->name('pharmacy.moveDrugs');
	Route::post('pharmacy/move-drug','PharmacistController@moveDrug')->name('pharmacy.moveDrug');
	Route::post('pharmacy/flag-delivered','PharmacistController@markDelivered')->name('pharmacy.markDelivered');


	Route::get('diagnostic/profile','DiagnosticController@profile')->name('diagnostic.profile');
	Route::put('diagnostic/{user}/profile','DiagnosticController@updateProfile')->name('diagnostic.update-profile');
	Route::get('diagnostic/licence','DiagnosticController@licence')->name('diagnostic.licence');
	Route::put('diagnostic/{user}/upload-licence','DiagnosticController@uploadLicence')->name('diagnostic.upload-licence');
	Route::post('diagnostic/{user}/delete-licence','DiagnosticController@deleteLicence')->name('diagnostic.delete-licence');
	Route::get('diagnostic/test','DiagnosticController@showTest')->name('diagnostic.tests');
	Route::get('diagnostic/central-tests','DiagnosticController@centralTest')->name('diagnostic.centralTest');
	Route::post('diagnostic/test/{user}','DiagnosticController@storeTest')->name('diagnostic.storeTest');
	Route::put('diagnostic/test/{test}','DiagnosticController@updateTest')->name('diagnostic.updateTest');
	Route::get('diagnostic/import-drug','DiagnosticController@importExcel')->name('diagnostic.importExcel');
	Route::get('diagnostic/transaction','DiagnosticController@drugTransaction')->name('diagnostic.drugTransaction');
	Route::post('diagnostic/upload-drug','DiagnosticController@excelDrugUpload')->name('diagnostic.excelDrugUpload');
	Route::post('diagnostic/move-tests','DiagnosticController@moveTests')->name('diagnostic.moveTests');
	Route::post('diagnostic/move-test','DiagnosticController@moveTest')->name('diagnostic.moveTest');
	Route::post('diagnostic/flag-delivered','DiagnosticController@markDelivered')->name('diagnostic.markDelivered');


	Route::get('freelancer/profile','FreelancerController@profile')->name('freelancer.profile');
	Route::get('freelancer/register-patient','FreelancerController@register')->name('freelancer.register');
	Route::post('freelancer/add-patient','FreelancerController@addPatient')->name('freelancer.addPatient');
	Route::put('freelancer/{user}/profile','FreelancerController@updateProfile')->name('freelancer.update-profile');
	Route::get('freelancer/central-drugs','FreelancerController@centralDrug')->name('freelancer.centralDrugs');
	Route::get('freelancer/central-tests','FreelancerController@centralTest')->name('freelancer.centralTests');
	Route::get('freelancer/purse','FreelancerController@purse')->name('freelancer.purse');
	Route::get('freelancer/reviews','FreelancerController@reviews')->name('freelancer.reviews');
	Route::get('freelancer/chat-list','FreelancerController@chatHistory')->name('freelancer.chatHistory');
	Route::get('freelancer/{book}/chat','FreelancerController@showChat')->name('freelancer.showChat');
	Route::get('freelancer/drugs/{book}','FreelancerController@listDrugs')->name('freelancer.listDrugs');
	Route::post('freelancer/sendDrug/{book}','FreelancerController@sendDrug')->name('freelancer.sendDrug');

	Route::get('admin/patients','AdminController@patients')->name('admin.patients');
	Route::get('admin/doctors','AdminController@doctors')->name('admin.doctors');
	Route::get('admin/pharmacy','AdminController@pharmacy')->name('admin.pharmacy');
	Route::get('admin/diagnostic','AdminController@diagnostic')->name('admin.diagnostic');
	Route::get('admin/freelancers','AdminController@freelancers')->name('admin.freelancers');
	Route::get('admin/central-drugs','AdminController@centralDrug')->name('admin.centralDrugs');
	Route::get('admin/central-tests','AdminController@centralTest')->name('admin.centralTests');
	Route::get('admin/drug-transaction','AdminController@drugTransaction')->name('admin.drugTransaction');
	Route::post('admin/import-drugs','AdminController@importDrugs')->name('admin.importDrugs');
	Route::post('admin/import-tests','AdminController@importTests')->name('admin.importTests');
	Route::put('admin/approval','AdminController@approveUser')->name('admin.approval');
	Route::put('admin/update-drug/{centralDrug}','AdminController@updateDrug')->name('admin.updateDrug');
	Route::put('admin/update-test/{centraltest}','AdminController@updateTest')->name('admin.updateTest');
	Route::put('admin/cost-prescription/{upload}','AdminController@addCostPrescription')->name('admin.addCostPrescription');
	Route::post('admin/flag-drug-payment','AdminController@disbuseDrugPayment')->name('admin.disbuseDrugPayment');
	Route::post('admin/flag-book-payment','AdminController@disbuseBookingPayment')->name('admin.disbuseBookingPayment');
	Route::post('admin/drug-refund','AdminController@drugRefund')->name('admin.drugRefund');
	Route::post('admin/purse-paid','AdminController@markPursePaid')->name('admin.markPursePaid');
	Route::post('admin/createadmin','AdminController@createAdmin')->name('admin.createAdmin');
	Route::post('admin/book-refund','AdminController@bookRefund')->name('admin.bookRefund');
	Route::get('admin/bookings','AdminController@bookings')->name('admin.bookings');
	Route::get('admin/profile','AdminController@profile')->name('admin.profile');	
	Route::get('admin/subadmins','AdminController@subadmins')->name('admin.subadmins');	
	Route::get('admin/purse','AdminController@showPurse')->name('admin.showPurse');	
	Route::get('admin/prescriptions','AdminController@prescriptions')->name('admin.prescriptions');	


	Route::get('hypaac/profile','HypaacController@profile')->name('hypaac.profile');	


	Route::put('user/{user}/update-password','HomeController@updatePassword')->name('user.updatePassword');



	Route::resource('patient','PatientController');
	Route::resource('doctor','DoctorController');
	Route::resource('pharmacy','PharmacistController');
	Route::resource('diagnostic','DiagnosticController');
	Route::resource('freelancer','FreelancerController');
	Route::resource('admin','AdminController');
	Route::resource('hypaac','HypaacController');


	Route::get('user/choose-user-type', function(){
		  return view('home.choose_type');
	})->name('choose_type');

	
});

