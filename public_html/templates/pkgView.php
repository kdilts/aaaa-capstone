<?php
//if(session_status() !== PHP_SESSION_ACTIVE) {
//	session_start();
//}
//if(empty($_SESSION["adUser"]) === false) { ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<h2>Parking</h2>
				<table class="table table-bordered table-hover table-parking">
					<thead>
						<tr>
							<td>Parking:</td>
						</tr>
						<tr>
							<td>Last</td>
							<td>First</td>
							<td>Cohort</td>
							<td>Swipe #</td>
							<td>Placard #</td>
							<td>Check Out Date</td>
							<td>Check In Date</td>
							<td>Status</td>
						</tr>
					</thead>
					<tr *ngFor = "let studentPermit of studentPermits">
						<td>{{studentPermit.info[3].applicationLastName}}</td>
						<td>{{studentPermit.info[3].applicationFirstName}}</td>

					<td>
						<ul class="list-unstyled">
							<li *ngFor="let cohort of studentPermit.info[4]">
								{{cohort.cohortName}}
							</li>
						</ul>
					</td>

						<td>{{studentPermit.info[1].swipeNumber}}</td>
						<td>{{studentPermit.info[0].placardNumber}}</td>
						<td>{{studentPermit.studentPermitCheckOutDate | date: 'medium'}}</td>
						<td>{{studentPermit.studentPermitCheckInDate | date: 'medium'}}</td>
						<td>{{studentPermit.info[2].statusTypeName}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<?php //} else {
//
//}