<section>
	<div class="row">
		<div class="col-sm-12">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation"><a routerLink="/appView/">Applicants</a></li>
				<li role="presentation"><a routerLink="/prsView/">Prospects</a></li>
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