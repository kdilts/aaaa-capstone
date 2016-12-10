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
					<td><button>+</button></td>
				</tr>
				<tr>
					<td>Date</td>
					<td>Preview</td>
				</tr>
			</thead>
			<tr>
				<td>{{ application.applicationDateTime }}</td>
				<td>preivew content</td>
			</tr>
		</table>
	</div>
</div>