<!DOCTYPE html>
<html>

	<head lang="en">
		<script data-require="jquery@2.2.0" data-semver="2.2.0"
				  src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6"
				  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="style.css"/>
		<script src="script.js"></script>
		<title> Streamline CNM Applicant</title>
	</head>

	<body>
		<section>
			<div class="container">
				<div class="jumbotron text-center">
					<h1>Stream Line CNM Applicant</h1>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<ul class="nav nav-pills">
					<li role="presentation"><a href="#">Home</a></li>
					<li role="presentation"><a href="#">Applicant</a></li>
					<li role="presentation"><a href="#">Permits</a></li>
					<li role="presentation"><a href="#">Students</a></li>
				</ul>
				<div class="row">
					<div class="col-sm-12">
						<form class="navbar-form navbar-right">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Search">
							</div>
							<button type="submit" class="btn btn-default">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</section>

		<section>=
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="well">
							<ul>
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
							<ul>
								<div class="md-modal md-effect-1" id="modal-3">
									<div class="md-content">
										<h3>Person Information</h3>
										<div>
											<ul>
												<li><strong>Name:</strong> John Dice.</li>
												<li><strong>DOB:</strong> 28th July 1995.</li>
												<li><strong>From where?:</strong> Chicago.</li>
												<li><strong>Occupation:</strong> Student.</li>
												<li><strong>About:</strong> Information.</li>
												<li><strong>Contact:</strong> Contact stuff.</li>
											</ul>
											<button class="md-close">Close</button>
										</div>
									</div>
								</div>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- add modal here -->
		<div class="modal fade" id="add-student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Student</h4>
					</div>
					<div class="modal-body">
						<label for="name">Name <span class="text-danger">*</span></label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
							<input type="text" class="form-control" id="name" name="name" placeholder="Name">
						</div>
					</div>
					<div class="form-group">
						<label for="email">Email <span class="text-danger">*</span></label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</div>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="subject">Subject</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</div>
							<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
						</div>
					</div>
					<div class="form-group">
						<label for="message">Message <span class="text-danger">*</span></label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-comment" aria-hidden="true"></i>
							</div>
							<textarea class="form-control" rows="5" id="message" name="message"
										 placeholder="Message (2000 characters max)"></textarea>
						</div>
					</div>
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