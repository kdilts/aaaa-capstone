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
					<h1>Streamline</h1>
					<h1>Application Form</h1>
				</div>
			</div>
		</section>
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
				<script type="text/javascript">
					$(function () {
						$('#datetimepicker1').datetimepicker();
					});
				</script>
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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
			<script; src="bootstrap/js/bootstrap.min.js"></script>
	</body>

</html>