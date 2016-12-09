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
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
							  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">CNM</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<form class="navbar-form navbar-right">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Search</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Student</a></li>
						<li><a href="#">Parking</a></li>
						<li><a href="#">Sign Out</a></li>
						<li role="separator" class="divider"></li>
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

		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Name</th>
					<th>Position</th>
					<th>Office</th>
					<th>Age</th>
					<th>Start date</th>
					<th>Salary</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Name</th>
					<th>Position</th>
					<th>Office</th>
					<th>Age</th>
					<th>Start date</th>
					<th>Salary</th>
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td>Tiger Nixon</td>
					<td>System Architect</td>
					<td>Edinburgh</td>
					<td>61</td>
					<td>2011/04/25</td>
					<td>$320,800</td>
				</tr>
				<tr>
					<td>Garrett Winters</td>
					<td>Accountant</td>
					<td>Tokyo</td>
					<td>63</td>
					<td>2011/07/25</td>
					<td>$170,750</td>
				</tr>
				<tr>
					<td>Ashton Cox</td>
					<td>Junior Technical Author</td>
					<td>San Francisco</td>
					<td>66</td>
					<td>2009/01/12</td>
					<td>$86,000</td>
				</tr>
				<tr>
					<td>Cedric Kelly</td>
					<td>Senior Javascript Developer</td>
					<td>Edinburgh</td>
					<td>22</td>
					<td>2012/03/29</td>
					<td>$433,060</td>
				</tr>
				<tr>
					<td>Airi Satou</td>
					<td>Accountant</td>
					<td>Tokyo</td>
					<td>33</td>
					<td>2008/11/28</td>
					<td>$162,700</td>
				</tr>
				<tr>
					<td>Brielle Williamson</td>
					<td>Integration Specialist</td>
					<td>New York</td>
					<td>61</td>
					<td>2012/12/02</td>
					<td>$372,000</td>
				</tr>
				<tr>
					<td>Herrod Chandler</td>
					<td>Sales Assistant</td>
					<td>San Francisco</td>
					<td>59</td>
					<td>2012/08/06</td>
					<td>$137,500</td>
				</tr>
				<tr>
					<td>Rhona Davidson</td>
					<td>Integration Specialist</td>
					<td>Tokyo</td>
					<td>55</td>
					<td>2010/10/14</td>
					<td>$327,900</td>
				</tr>
				<tr>
					<td>Colleen Hurst</td>
					<td>Javascript Developer</td>
					<td>San Francisco</td>
					<td>39</td>
					<td>2009/09/15</td>
					<td>$205,500</td>
				</tr>
				<tr>
					<td>Sonya Frost</td>
					<td>Software Engineer</td>
					<td>Edinburgh</td>
					<td>23</td>
					<td>2008/12/13</td>
					<td>$103,600</td>
				</tr>
				<tr>
					<td>Jena Gaines</td>
					<td>Office Manager</td>
					<td>London</td>
					<td>30</td>
					<td>2008/12/19</td>
					<td>$90,560</td>
				</tr>
				<tr>
					<td>Quinn Flynn</td>
					<td>Support Lead</td>
					<td>Edinburgh</td>
					<td>22</td>
					<td>2013/03/03</td>
					<td>$342,000</td>
				</tr>
				<tr>
					<td>Michael Bruce</td>
					<td>Javascript Developer</td>
					<td>Singapore</td>
					<td>29</td>
					<td>2011/06/27</td>
					<td>$183,000</td>
				</tr>
				<tr>
					<td>Donna Snider</td>
					<td>Customer Support</td>
					<td>New York</td>
					<td>27</td>
					<td>2011/01/25</td>
					<td>$112,000</td>
				</tr>
			</tbody>
		</table>
		<div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
			<ul class="pagination">
				<li class="pagination_button previous disabled" id="example_previous">
					<a href="#" arial-controls="example" data-dt-idx="0" tabindex="0">Previous</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">1</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">2</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">3</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">4</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">5</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">6</a>
				</li>
				<li class="paginate_button next" id="example_next"><a href="#" aria-controls="example" data-dt-idx="7" tabindex="0">Next</a>
				</li>
			</ul>
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
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>

	</body>

</html>