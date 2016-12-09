<!DOCTYPE html>
<html>

	<head lang="en">
		<link rel="stylesheet" href="_css/datepicker.css">
		<link rel="stylesheet" href="_css/bootstrap.css">
		<link rel="stylesheet" href="_css/bootstrap-responsive.css">
		<script type="text/javascript" src="datepicker/bootstrap-datepicker.js"></script>
	</head>
	<head runat="server">
		<title>Test Zone</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="Css/datepicker.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="../Js/bootstrap-datepicker.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#pickyDate').datepicker({
					format: "dd/mm/yyyy"
				});
			});
		</script>
		<script data-require="jquery@2.2.0" data-semver="2.2.0" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link data-require=bootstrap-datepicker.css
		bootstrap-datepicker.standalone.css
		<link rel="stylesheet" href="style.css" />
		<script src="script.js"></script>
	</head>


	<!----------------- Java Script for date stamp ------------------>
	<!---------- var isoDate = new Date(new Date().getTime()).toISOString();
	$('#utc').html(isoDate); ------------->

	<body>
		<section>
			<div class="container">
				<div class="jumbotron text-center">
					<h1>Streamline CNM Application</h1>
				</div>
			</div>
		</section>
		<div class="container">
			<div class="row">
				<div class='col-sm-6'>
					<div class="form-group">
						<div class='input-group date' id='datetimepicker1'>
							<input type='text' class="form-control" />
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
						</div>
					</div>
				</div>

				<! ----------------------- date picker ------------------->
<!--------------------- date stamp --------------------->
		<div class="container">
			<h2 id="utc"></h2>
		</div>
		<form>
			<div class="form-group">
				<input class="" type="text" required name="applicationId" placeholder="Application Id">
			</div>
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
				<br />
				<!--								<input class="" type="text" required name="applicationExperience" placeholder="Experience">-->
			</div>
			<div class="form-group">
				<input class="" type="text" required name="applicationUtmCampaign" placeholder="Application Utm Campaign">
			</div>
			<br />
			<div class="form-group">
				<input class="" type="text" required name="applicationUtmMedium" placeholder="Application Utm Medium">
			</div>
			<br />
			<div class="form-group">
				<input class="" type="text" required name="applicationUtmSource" placeholder="Application Utm Source">
			</div>
			<br />
			<!--							<input class="" type="text" required name="" placeholder="">-->
			<!--							<input class="" type="text" required name="" placeholder="">-->
			<!--							<input class="" type="text" required name="" placeholder="">-->
			<label class="checkbox"></label>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
		</form>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		<!--- Date Picker  Special Version of Bootstrap that only a---------->
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

		<!-- Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="https://formden.com/static/cdn-awesome/4.4.0/css/font-awesome.min.css"/>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
			<script; src="bootstrap/js/bootstrap.min.js"></script>
	</body>

</html>