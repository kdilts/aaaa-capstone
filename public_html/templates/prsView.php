<section>
	<div class="row">
		<div class="col-sm-12">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation"><a routerLink="/appView/">Applicants</a></li>
				<li role="presentation"><a routerLink="/prsView/">Prospect</a></li>
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
					</tr>
				</thead>
				<tbody>
					<tr *ngFor="let prospectCohort of prospectCohorts">
						<td>{{ prospectCohort.info[0].prospectFirstName }}</td>
						<td>{{ prospectCohort.info[0].prospectLastName }}</td>
						<td>{{ prospectCohort.info[0].prospectEmail }}</td>
						<td>{{ prospectCohort.info[1].cohortName }}</td>
					</tr>
				</tbody>
			</table>
		</div><!--end of .table-responsive-->
	</div>
</section>