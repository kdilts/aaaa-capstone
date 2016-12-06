<!DOCTYPE html>
<html>

	<head lang="en">
		<script data-require="jquery@2.2.0" data-semver="2.2.0" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="style.css" />
		<script src="script.js"></script>
	</head>

	<body>
		<section>
			<div class="container">
				<div class="jumbotron text-center">
					<h1>Welcome to AAAA!</h1>
				</div>
			</div>
		</section>
		<form>
			<br />

		<section>
			<div class="container">
				<ul class="nav nav-pills">
					<li role="presentation"><a href="#">Home</a></li>
					<li role="presentation"><a href="#">Applicant</a></li>
					<li role="presentation"><a href="#">Permits</a></li>
					<li role="presentation"><a href="#">Students</a></li>
				</ul>
			</div>
		</section>
			</form>
		<form>
			<br />
			<label for="foo" class="col-sm-6 control-label">foo</label>
			<select class="form-control" placeholder="2 blocks wide" class="col-xs-6 control-label">Select</label>
				<option>Application</option>
				<option>Bridge</option>
				<option>Cohort</option>
				<option>Note Type</option>
				<option>Prospect</option>
				<option>Status Type</option>
				<option>Placard<</option>
				<option>Swipe</option>
				<option>Aplication Cohort</option>
				<option>Student Permit</option>
				<option>Prospect Cohort</option>
				<option>Note</option>
			</select>
		</form>
		<section>
			<br />
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="well">
							<ul>
								<br />
								<li>Student Name</li>
								<li>Student Name</li>
								<li>Student Name</li>
								<li>Student Name</li>
							</ul>
							<button class="btn btn-info" data-target="#add-student" data-toggle="modal">Add Student</button>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="well">
							<p>This is some student data...</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- add modal here -->
		</form>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">

			<script; src="bootstrap/js/bootstrap.min.js"></script>
	</body>
		<div class="modal fade" id="add-student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Student</h4>
					</div>
					<div class="modal-body">
						<form class="" method="POST" action="../public_html/api/application/index.php">
							<h2 class="">Add Student</h2>
							<div class="form-group">
								<input class="" type="text" required name="applicationFirstName" placeholder="First Name">
							</div>
							<div class="form-group">
							<input class="" type="text" required name="applicationLastName" placeholder="Last Name">
							</div>
							<br />
							<div class="form-group">
								<input class="" type="text" required name="applicationEmail" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="" type="text" required name="applicationPhoneNumber" placeholder="Phone Number">
							</div>
							<br />
							<div class="form-group">
								<input class="" type="text" required name="applicationSource" placeholder="Source">
							</div>
							<div class="form-group">
								<label for="aboutYouArea">About You</label>
								<textarea class="form-control-1" id="aboutYouArea" rows="4" required name ="applicationAboutYou"></textarea>
							</div>
							<br />
							<div class="form-group">
<!--								<input class="" type="text" required name="applicationHopeToAccomplish" placeholder="Hope to Accomplish">-->
								<label for="htaArea">Hope to Accomplish</label>
								<textarea class="form-control" id="htaArea" rows="4" required name ="applicationHopeToAccomplish"></textarea>
							</div>
							<br />
							<div class="form-group">
								<label for="experienceArea">Experience</label>
								<textarea class="form-control" id="experienceAreaArea" rows="4" required name ="applicationExperience"></textarea>
<!--								<input class="" type="text" required name="applicationExperience" placeholder="Experience">-->
							</div>
<!--							<input class="" type="text" required name="" placeholder="">-->
<!--							<input class="" type="text" required name="" placeholder="">-->
<!--							<input class="" type="text" required name="" placeholder="">-->
							<label class="checkbox"></label>
							<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>

				</div>
			</div>
		</div>

	</body>

</html>