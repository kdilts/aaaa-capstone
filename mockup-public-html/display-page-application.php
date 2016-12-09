<!DOCTYPE html>
<html>
	<head lang="en">
		<script data-require="jquery@2.2.0" data-semver="2.2.0"
				  src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6"
				  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script
			src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="style.css"/>
		<style type="text/css">
	.bs-example{
		margin: 20px
		}
		</style>
		<script src="script.js"></script>
		<title> Streamline CNM Applicant</title>
		<h1>Insert Page Stream Line CNM</h1>
	</head>
	<br />
	<div class="container "
	<section>
		<div class="col-md-6">
			<div class="row">
				<div class="col-xs-8 col-md-6">
					<div>
						<div class="col-xs-4 col-sm-6">
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
		</div>
		</div>
		</div>
		</div>
		<br/>
		<div class="bs-example">
				<table class="table table-bordered" table-striped table-hover">

								<thead><tr>
									</tr>
									<th>Date</th>
									<th>Type</th>
									<th>Preview</th>
								</thead>
								<tfoot>
									<tr>
										<td><input> </input></td>
										<td><input> </input></td>
										<td><input> </input></td>
									</tr>
									<tr>
										<td><input> </input></td>
										<td><input> </input></td>
										<td><input> </input></td></tr>
									<td colspan="3">This is the foot of the table</td>
							</div>
							</tbody>
				</table>
		</table>
	</section>

	<!-- add modal here -->
	<div class="modal fade" id="add-student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add Student</h4>
				</div>
				<div class="modal-body">
					<label for="name">Name <span class="text-danger">*</span></label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-user" aria-hidden="true"></i>
						</div>
						<input type="text" class="form-control" id="name" name="name" placeholder="Name">
					</div>
				</div>
				<div class="form-group">
					<label for="email">Email <span class="text-danger">*</span></label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</div>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label for="subject">Subject</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</div>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
					</div>
				</div>
				<div class="form-group">
					<label for="message">Message <span class="text-danger">*</span></label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<textarea class="form-control" rows="5" id="message" name="message"
									 placeholder="Message (2000 characters max)"></textarea>
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
	</body>
</html>
