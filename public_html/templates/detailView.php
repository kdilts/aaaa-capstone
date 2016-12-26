<div class="row" xmlns="http://www.w3.org/1999/html">
	<div class="col-xs-7">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<td>Applicant Details:</td>
					<td></td>
				</tr>
			</thead>
			<tr>
				<td>First Name:</td>
				<td>{{application.applicationFirstName}}</td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td>{{application.applicationLastName}}</td>
			</tr>
			<tr>
				<td>Cohorts:</td>
				<td>
					<ul class="list-unstyled">
						<li *ngFor="let applicationCohort of applicationCohorts">
							{{ applicationCohort.info[1].cohortName }}
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td>{{application.applicationEmail}}</td>
			</tr>
			<tr>
				<td>Phone Number:</td>
				<td>{{application.applicationPhoneNumber}}</td>
			</tr>
			<tr>
				<td>Where did you hear about DDC from?</td>
				<td>{{application.applicationSource}}</td>
			</tr>
			<tr>
				<td>About You:</td>
				<td>{{application.applicationAboutYou}}</td>
			</tr>
			<tr>
				<td>Hope To Accomplish:</td>
				<td>{{application.applicationHopeToAccomplish}}</td>
			</tr>
			<tr>
				<td>Previous Experience:</td>
				<td>{{application.applicationExperience}}</td>
			</tr>
			<tr>
				<td>Date Submitted:</td>
<!--				<td>{{ application.applicationDateTime }}</td>-->
				<td>{{ testDate | date : 'medium' }}</td>
			</tr>
		</table>
	</div>

	<div class="col-xs-5">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<td>Notes:</td>
					<td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">+</button>
						<div id="myModal" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Confirmation</h4>
									</div>

									<!-- FORM -->
									<form #noteForm="ngForm" name="detailView" id="detailView" class="form-horizontal well" (ngSubmit)="createNote();" novalidate>
										<div class="modal-body">

											<div class="form-group" [ngClass]="{ 'has-error': noteContent.touched && noteContent.invalid }">
												<label for="noteContent">Content:</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-comment" aria-hidden="true"></i>
													</div>
													<textarea name="noteContent" id="noteContent" class="form-control" maxlength="255" required [(ngModel)]="note.noteContent" #noteContent="ngModel" rows="5"></textarea>
												</div>
												<div [hidden]="noteContent.valid || noteContent.pristine" class="alert alert-danger" role="alert">
													<p *ngIf="noteContent.errors?.required">Note content is required.</p>
													<p *ngIf="noteContent.errors?.maxlength">Note content is too long.</p>
												</div>
											</div>
											<label>Note Type:</label>
											<select class="form-control" id="noteNoteTypeId" name="noteNoteTypeID" [(ngModel)]="note.noteNoteTypeId" required>
												<option *ngFor="let noteType of noteTypes" value="{{noteType.noteTypeId}}">{{noteType.noteTypeName}}</option>
											</select>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<input type="submit" class="btn btn-info" value="Submit">
										</div>
									</form>
									<!-- FORM -->

								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Date</td>
					<td>Preview</td>
				</tr>
			</thead>
			<tr *ngFor="let note of notes">
				<td>{{ note.noteDateTime | date : 'medium' }}</td>
				<td>{{ note.noteContent | slice:0:15 }}</td>
			</tr>
		</table>
	</div>
</div>
