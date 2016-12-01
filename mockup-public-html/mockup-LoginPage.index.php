<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<script data-require="jquery@2.2.0" data-semver="2.2.0"
				  src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6"
				  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="style.css"/>
		<script src="script.js"></script>
		<title>Stream Line CNM Log in Page</title>
	</head>

	<body class="sfooter">
		<div class="sfooter-content">
			<div class="row"></div>
			<header>
				<div class="container">
				</div>
			</header>
			<!-- container -->
			<main>
				<div class="container">
					<div class="jumbotron text-center">
						<h1 class="text-center">Stream Line CNM</h1>
						<div class="form-wrap row">
							<div class="col-sm-12 col-sm-offset-12">
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
						</div>
					</div>
				</div>
				<!-- insert contact form here -->
				<form id="contact-form">
					<div class="form-group">
						<div class="container">
							<div class="row">
								<div class="col-sm-6">
								</div>
								<div class="form-group">
									<label for="inputEmail" class="control-label">Email</label>
									<input type="email" class="form-control" id="inputEmail" placeholder="Email"
											 data-error="Bruh, that email address is invalid" required>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label for="inputPassword" class="control-label">Password</label>
									<div class="form-inline row">
										<div class="form-group col-sm-6">
											<input type="password" data-minlength="6" class="form-control" id="inputPassword"
													 placeholder="Password" required>
											<div class="help-block">Minimum of 6 characters</div>
										</div>
										<div class="form-group col-sm-6">
											<input type="password" class="form-control" id="inputPasswordConfirm"
													 data-match="#inputPassword" data-match-error="Whoops, these don't match"
													 placeholder="Confirm" required>
											<div class="help-block with-errors">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="footer">
						<button type="button" class="btn btn-default" data-dismiss="footer">Enter</button>

					</div>
			</main>
	</body>
</html>