@extends('layouts.main')

@section('content')
	
	<div id="breadcrumb">
			<div class="container">
				<ul>
					<li><a href="#">Home</a></li>
					
					<li>Choose User Type</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_120">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div id="confirm">
						<div class="card">
							<div class="card-body">
							<form method="POST" action="{{route('updateUserType',auth()->user()->id)}}">
								@method('PUT')
								@csrf
								<div class="form-group has-error">
                                        <label><strong>Who are you</strong></label>
                                        <select name="type" required id="type" class="form-control">
                                            <option value="1">Patient</option>
                                            <option value="2">Doctor</option>
                                            <option value="3">Pharmacist Partner</option>
                                            <option value="4">Diagnostic Partner</option>
                                            <option value="5">Freelance Pharmacist</option>
                                        </select>
                                        @error('type')
                                            <span class="help-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <input class="btn_1" type="submit" value="Save">
                                </div>
                            </form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
@endsection