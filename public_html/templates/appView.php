
<section class="container-fluid">
	<div class="row application-page">
		<div class="col-xs-12">
			<h2>Applications</h2>
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
					<tr *ngFor="let applicationCohort of applicationCohorts" (click)="switchApplication(applicationCohort.info[0]);">
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
