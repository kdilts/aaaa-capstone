<div class="container">
	<div class="row">
		<div class="col-md-12">

			<form #quickProspectForm="ngForm" name="quickProspectForm" id="quickProspectForm" class="form-horizontal well"  (ngSubmit)="createProspect();" novalidate>

				<div class="form-group">
					<label for="inputName" class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="prospectLastName" name="prospectLastName"  placeholder="Enter Name" [(ngModel)]="prospect.prospectLastName" #prospectLastName="ngModel" >
					</div>
				</div>

				<div class="form-group">
					<label for="inputName" class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="prospectFirstName" name="prospectFirstName"  placeholder="Enter First Name" [(ngModel)]="prospect.prospectFirstName" #prospectFirstName="ngModel" >
					</div>
				</div>

				<div class="form-group">
					<label for="inputPhone" class="col-sm-2 control-label">Phone</label>
					<div class="col-sm-10">
						<input type="tel" class="form-control" id="prospectPhoneNumber" name="prospectPhoneNumber" placeholder="Phone Number" [(ngModel)]="prospect.prospectPhoneNumber" #prospectPhoneNumber="ngModel">
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="prospectEmail" name="prospectEmail" placeholder="Email" [(ngModel)]="prospect.prospectEmail" #prospectEmail="ngModel">
					</div>
				</div>

				<div class="form-group">
					<label for="inputCohort" class="col-sm-2 control-label">Cohort</label>
					<div class="col-sm-10">
						<select class="form-control" id="cohorts" required>
							<option *ngFor="let cohort of cohorts" value="cohortName">{{cohort.cohortName}}</option>
						</select>
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Enter</button>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>
