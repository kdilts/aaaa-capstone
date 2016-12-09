<!DOCTYPE html>
<html>

	<head lang="en">
		<script data-require="jquery@2.2.0" data-semver="2.2.0"
				  src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6"
				  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<title>Streamline CNM</title>
	</head>

	<body>
		<div class="container">
			<section>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs nav-justified">
							<li role="presentation"><a href="#">Applicants</a></li>
							<li role="presentation"><a href="#">Prospects</a></li>
						</ul>
					</div>
				</div>
			</section>

			<section>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Last</th>
									<th>First</th>
									<th>Email</th>
									<th>Cohort</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<tr *ngFor="let application of applications">
									<td>{{ application.applicationFirstName }}</td>
									<td>{{ application.applicationLastName }}</td>
									<td>{{ application.applicationEmail }}</td>
									<td> test </td>
									<td>{{ application.applicationDateTime | date: 'medium' }}</td>
								</tr>
							</tbody>
						</table>
					</div><!--end of .table-responsive-->
				</div>
			</section>
		</div>
	</body>
</html>