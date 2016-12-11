<div class="row">
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
					<ul>
<!--						<li *ngFor="let applicationCohort of applicationCohorts">-->
<!--							test-->
<!--						</li>-->
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
				<td>{{ application.applicationDateTime }}</td>
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
									<form id="note-form" action="../api/noteSubmit.php" method="post">
									<div class="modal-body">

										<textarea class="form-control" rows="5" id="noteContent" name="noteContent"
													 placeholder="Message (2000 characters max)"></textarea>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<input type="submit" class="btn btn-primary" value="Submit">
									</div>
									</form>
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