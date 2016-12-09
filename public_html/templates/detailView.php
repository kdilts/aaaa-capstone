<!DOCTYPE html>
<html>
	<head lang="en">
		<?php require_once("../php/partials/headlib.php"); ?>
		<title>Streamline CNM</title>
	</head>

	<body>
		<div class="container">
			<?php require_once("../php/partials/navbar.php"); ?>

			<h1>Detail View</h1>
			<h3>First Name: {{application.applicationFirstName}}</h3>
			<h3>Last Name: {{application.applicationLastName}}</h3>
			<h3>Email: {{application.applicationEmail}}</h3>
			<h3>Phone Number: {{application.applicationPhoneNumber}}</h3>
			<h3>Where did you hear about DDC from? {{application.applicationSource}}</h3>
			<h3>About You:{{application.applicationAboutYou}}</h3>
			<h3>Hope To Accomplish: {{application.applicationHopeToAccomplish}}</h3>
			<h3>Previous Experience: {{application.applicationExperience}}</h3>
			<h3>Date Submitted: {{application.applicationDateTime}}</h3>
		</div>
	</body>
</html>