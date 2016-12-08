<!DOCTYPE html>
<html>

	<head lang="en">
		<script data-require="jquery@2.2.0" data-semver="2.2.0"
				  src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6"
				  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="style.css"/>
		<script src="script.js"></script>
		<title> Streamline CNM Applicant</title>
	</head>

	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">CNM</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-navright">
						<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
						<li><a href="#">Link</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Separated link</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
					</ul>
					<form class="navbar-form navbar-right">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Link</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>

		<section>
			<div class="container">
				<ul class="nav nav-tabs nav-justified">
					<li role="presentation"><a href="#">Applicants</a></li>
					<li role="presentation"><a href="#">Prospects</a></li>
				</ul>
				<div class="row">
					<div class="col-sm-12">
					</div>
				</div>
			</div>
		</section>

		<section>=
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="well">
							<h2>Responsive Table with Bootstrap</h2>

							<div class="container">
								<div class="row">
									<div class="col-xs-12">
										<div class="table-responsive">
											<table
												summary="This table shows how to create responsive tables using Bootstrap's default functionality"
												class="table table-bordered table-hover">
												<caption class="text-center">An example of a responsive table based on <a
														href="http://getbootstrap.com/css/#tables-responsive" target="_blank">Bootstrap</a>:
												</caption>
												<thead>
													<tr>
														<th>Country</th>
														<th>Languages</th>
														<th>Population</th>
														<th>Median Age</th>
														<th>Area (Km²)</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Argentina</td>
														<td>Spanish (official), English, Italian, German, French</td>
														<td>41,803,125</td>
														<td>31.3</td>
														<td>2,780,387</td>
													</tr>
													<tr>
														<td>Australia</td>
														<td>English 79%, native and other languages</td>
														<td>23,630,169</td>
														<td>37.3</td>
														<td>7,739,983</td>
													</tr>
													<tr>
														<td>Greece</td>
														<td>Greek 99% (official), English, French</td>
														<td>11,128,404</td>
														<td>43.2</td>
														<td>131,956</td>
													</tr>
													<tr>
														<td>Luxembourg</td>
														<td>Luxermbourgish (national) French, German (both administrative)</td>
														<td>536,761</td>
														<td>39.1</td>
														<td>2,586</td>
													</tr>
													<tr>
														<td>Russia</td>
														<td>Russian, others</td>
														<td>142,467,651</td>
														<td>38.4</td>
														<td>17,076,310</td>
													</tr>
													<tr>
														<td>Sweden</td>
														<td>Swedish, small Sami- and Finnish-speaking minorities</td>
														<td>9,631,261</td>
														<td>41.1</td>
														<td>449,954</td>
													</tr>
												</tbody>
												<tfoot>
													<tr>
														<td colspan="5" class="text-center">Data retrieved from <a
																href="http://www.infoplease.com/ipa/A0855611.html" target="_blank">infoplease</a>
															and <a
																href="http://www.worldometers.info/world-population/population-by-country/"
																target="_blank">worldometers</a>.
														</td>
													</tr>
												</tfoot>
											</table>
										</div><!--end of .table-responsive-->
									</div>
								</div>
							</div>

							<p class="p">Demo by George Martsoukos. <a
									href="http://www.sitepoint.com/responsive-data-tables-comprehensive-list-solutions"
									target="_blank">See article</a>.</p>

							<button class="btn btn-info" data-target="#add-student" data-toggle="modal">Add Student</button>
						</div>
					</div>
				</div>
			</div>
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