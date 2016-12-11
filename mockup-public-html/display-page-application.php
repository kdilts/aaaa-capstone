<!DOCTYPE html>
<html>
	<head lang="en">
		<script data-require="jquery@2.2.0" data-semver="2.2.0"
				  src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6"
				  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="style.css"/>
		<style type="text/css"></style>
		<script src="script.js"></script>
		<title>Display Page of Application</title>
		<br />

		<!------- Home and Close button in Nav bar ------->
		<title>Display Page of Application</title>
		<!------------ Home button in Nav bar ------------->
		<button type="button" class="btn btn-default navbar-btn">Home</button>
		<h1 class="text-center">Application Detail</h1>
	</head>

	</head>
	<header>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
							  data-target="#bs-example-navbar-collapse-1">

						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>

					</button>
					<a class="navbar-brand" href="#">
						<img src="../public_html/img/image-of-fullstack.png/150x50&image=Logo" alt="">
					</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Home</a></li>
						<li><a href="#">Close</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!--------------------------- display of Application details ---------------------------------->

	<div class="jumbotron">

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-md-6 col-md-6">
					<h3><span class="text"></span></h3>
					<h4>Applicant</h4>
					<ul>

					</ul>

					<div class="col-md-6 col-md-12">
						<h3><span class="text"></span></h3>
					</div>
				</div>
			</div>
		</div>
		<ul>
			<li><strong>Name:</strong>Dave Coder.</li>
			<li><strong>Email:</strong> Dave Code@gmail.com.</li>
			<li><strong>Cohort</strong> Deep Dive Fall.</li>
			<li><strong>Tel:</strong> (505) 876-55-44li>
			<li><strong>Date:</strong> mm/dd/yyyy.</li>
			<li><strong>Contact:</strong> Contact stuff.</li>
		</ul>
	</div>

	<!----------- Applicant detail ----------->


	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>

			</tr>
		</thead>
		<tfoot>
			<tr>

				<br/>
				<div class="bs-example">
					<table class="table table-bordered" table-striped table-hover">

		<thead><tr>
			</tr>
			<th>Date</th>
			<th>Type</th>
			<th>Preview</th>
		</thead>
		<tr>
			<th>Notes</th>
			<td><input> </input></td>
			<td><input> </input></td>
			<td><input> </input></td>
		</tr>
		<td colspan="3">This is the foot of the table</td>
		</div>
	</table>
	</table>
	</section>
	<!---------------------------------- add modal here -------------------------------->
	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4> class="modal-title" </h4>
				</div>
				<div class="form-group">
					<label for="note">Note<span class="text-danger">*</span></label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<textarea class="form-control" rows="5" id="note" name="note"
									 placeholder="Note(2000 characters max)"></textarea>
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
</html>
