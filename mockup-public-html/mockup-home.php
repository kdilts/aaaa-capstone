<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Font Awesome -->
		<link type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" />

		<!-- Custom CSS Goes HERE -->
		<link type="text/css" href="mockup-stylesheet-css.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery - required for Bootstrap Components -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<title>Stream Line CNM</title>
	</head>
	<body>
		<section>
			<div class="container">
				<div class="col-xs-12">
					<div class="jumbotron text-center">
						<h1>Stream Line CNM</h1>
						<div
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<ul class="nav nav-pills">
					<li role="presentation"><a href="#">Home</a></li>
					<li role="presentation"><a href="#">Applicant</a></li>
					<li role="presentation"><a href="#">Permit</a> </li>
					<li role="presentation"><a href="#">Student</a> </li>
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
								<li>Student Name</li>
							</ul>
							<button class="bt btn-info" data-target="#add student" data-toggle="modal">Add Student</button>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="well">
							<p> This will be student Info</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- add modal here-->
		<div class="modal fade" id="add-student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal content">
					<div class="modal-header">
						<button type="button"class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Student</h4>
					</div>

				</div>
			</div>
		</div>
	</body>
</html>