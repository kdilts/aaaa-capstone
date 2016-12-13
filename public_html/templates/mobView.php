<div class="container">
	<div class="row">
		<div class="col-md-12">

			<form #quickProspectForm="ngForm" name="quickProspectForm" id="quickProspectForm" class="form-horizontal well"  (ngSubmit)="createProspect();" novalidate>
				<!--				First Name-->
				<div class="form-group" [ngClass]="{ 'has-error': prospectFirstName.touched && prospectFirstName.invalid }">
					<label for="prospectFirstName" class="col-sm-2 control-label">First Name: </label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<input type="text" class="form-control" id="prospectFirstName" name="prospectFirstName"  placeholder="Enter First Name" [(ngModel)]="prospect.prospectFirstName" #prospectFirstName="ngModel" maxlength="30" required />
					</div>
					<div [hidden]="prospectFirstName.valid || prospectFirstName.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="prospectFirstName.errors?.required">First Name is required.</p>
						<p *ngIf="prospectFirstName.errors?.maxlength">First Name is too long.</p>
					</div>
				</div>
				<!--				Last Name-->
				<div class="form-group" [ngClass]="{ 'has-error': prospectLastName.touched && prospectLastName.invalid }">
					<label for="prospectLastName" class="col-sm-2 control-label">Last Name: </label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<input type="text" class="form-control" id="prospectLastName" name="prospectLastName"  placeholder="Enter Last Name" [(ngModel)]="prospect.prospectLastName" #prospectLastName="ngModel" maxlength="30" required />
					</div>
					<div [hidden]="prospectLastName.valid || prospectLastName.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="prospectLastName.errors?.required">Last Name is required.</p>
						<p *ngIf="prospectLastName.errors?.maxlength">Last Name is too long.</p>
					</div>
				</div>
				<!--				Phone Number                     -->
				<div class="form-group"  [ngClass]="{ 'has-error': prospectPhoneNumber.touched && prospectPhoneNumber.invalid }">
					<label for="prospectPhoneNumber" class="col-sm-2 control-label">Phone: </label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<input type="tel" class="form-control" id="prospectPhoneNumber" name="prospectPhoneNumber" placeholder="Phone Number" [(ngModel)]="prospect.prospectPhoneNumber" #prospectPhoneNumber="ngModel" maxlength="30" required />
					</div>
				</div>
				<div [hidden]="prospectPhoneNumber.valid || prospectPhoneNumber.pristine" class="alert alert-danger" role="alert">
					<p *ngIf="prospectPhoneNumber.errors?.required">Phone Number is required.</p>
					<p *ngIf="prospectPhoneNumber.errors?.maxlength">Phone Number is too long.</p>
				</div>
				<!--				Email Address-->
				<div class="form-group"  [ngClass]="{ 'has-error': prospectEmail.touched && prospectEmail.invalid }">
					<label for="prospectEmail" class="col-sm-2 control-label">Email: </label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<input type="email" class="form-control" id="prospectEmail" name="prospectEmail" placeholder="Email" [(ngModel)]="prospect.prospectEmail" #prospectEmail="ngModel" maxlength="30" required />
					</div>
				</div>
				<div [hidden]="prospectEmail.valid || prospectEmail.pristine" class="alert alert-danger" role="alert">
					<p *ngIf="prospectEmail.errors?.required">Email is required.</p>
					<p *ngIf="prospectEmail.errors?.maxlength">Email is too long.</p>
				</div>

				<!--				Cohort-->
				<div class="form-group">
					<label for="prospectCohortId" class="col-sm-2 control-label">Cohort: </label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<select class="form-control" id="prospectCohortId" name="prospectCohortId" [(ngModel)]="prospect.prospectCohortId" required>
							<option *ngFor="let cohort of cohorts" value="{{cohort.cohortId}}">{{cohort.cohortName}}</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-info btn-lg" [disabled]="quickProspectForm.invalid"><i class="fa fa-share"></i> Submit</button>
						<button type="reset" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Reset</button>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>
