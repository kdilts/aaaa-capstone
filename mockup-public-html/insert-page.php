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
			<div class="form-group">
				<label for="inputName">Name</label>
				<input class="form-control" type="text" id="inputName" placeholder="Full Name" />
			</div>
			<div class="form-group">
				<label for="inputDOB">Date of Birth</label>
				<input class="form-control" type="date" id="inputDOB" />
			</div>
			<div class="form-group">
				<label for="inputName">Name</label>
				<input class="form-control" type="text" id="inputName" placeholder="Full Name" />
			</div>
		</form>

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

		<section>
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
							<p>This is some student data...</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- add modal here -->

		<form>
			<br />
			<select class="form-control">
				<option>Option 1</option>
				<option>Option 2</option>
				<option>Option 3</option>
				<option>Option 4</option>
				<option>Option 5</option>
			</select>
		</form>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">

			<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
		<div class="modal fade" id="add-student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Student</h4>
					</div>
					<div class="modal-body">
						...make form here!
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