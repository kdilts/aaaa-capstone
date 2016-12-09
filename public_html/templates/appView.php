<!DOCTYPE html>
<html>
	<head lang="en">
		<?php require_once("../php/partials/headlib.php"); ?>
		<title>Streamline CNM</title>
	</head>

	<body>
		<div class="container">
			<?php require_once("../php/partials/navbar.php"); ?>

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
								<tr *ngFor="let applicationCohort of applicationCohorts">
									<td>{{ applicationCohort.info[0].applicationFirstName }}</td>
									<td>{{ applicationCohort.info[0].applicationLastName }}</td>
									<td>{{ applicationCohort.info[0].applicationEmail }}</td>
									<td>{{ applicationCohort.info[1].cohortName }}</td>
									<td>{{ applicationCohort.info[0].applicationDateTime | date: 'medium' }}</td>
								</tr>
							</tbody>
						</table>
					</div><!--end of .table-responsive-->
				</div>
			</section>
		</div>
	</body>
</html>