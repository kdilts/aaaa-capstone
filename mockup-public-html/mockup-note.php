<!DOCTYP html>
<head lang="en">
			<meta charset="utf-8"
			<meta http-equiv="X-UA-Compatible" content="IE-edge">
			<meta name="viewport" content="width=device-width", initial-scale="1">
	<script data-require="jquery@2.2.0" data-semver="2.2.0" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script data-require="bootstrap@3.3.6" data-semver="3.3.6" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- jQuery - required for Bootstrap Components -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="style.css" />
	<script src="script.js"></script>
</head>

<body>
	<section>
		<div class="container">
			<div class="jumbotron text-center">
				<h1>Streamline CNM Note</h1>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="row">
			<div class='col-sm-6'>
				<div class="form-group">
					<div class='input-group date' id='datetimepicker1'>
						<input type='text' class="form-control" />
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(function () {
					$('#datetimepicker1').datetimepicker();
				});
			</script>
		</div>
	</div>
	<div class="list-group">
		<div>
			<div class="col-sm-6">
				<form class="form-horizontal">
					<div class="form-group">
						<div class="form-group">
							<label for="noteId" class="col-sm-4 control-label">Note Id</label>
							<div class="col-sm-10">
								<input type="noteid" class="form-control" id="inputNoteId" placeholder="NoteId">
							</div>
						</div>
						<div class="form-group">
							<label for="NoteAppllicationId" class="col-sm-4 control-label">Note Application Id</label>
							<div class="col-sm-10">
								<input type="noteApplicationId" class="form-control" id="inputNoteApplicationId" placeholder="NoteApplicationId">
							</div>
						</div>
						<div class="form-group">
							<label for="NoteProspectId" class="col-sm-4 control-label">Note Prospect Id</label>
							<div class="col-sm-10">
								<input type="noteProspectId" class="form-control" id="inputProspectId" placeholder="NoteProspectId">
							</div>
						</div>
						<div class="form-group">
							<label for="NoteType" class="col-sm-4 control-label">Note Type</label>
							<div class="col-sm-10">
								<input type="noteType" class="form-control" id="inputType" placeholder="NoteType">
							</div>
						</div>
						<div class="form-group">
							<label for="NoteBridgeId" class="col-sm-4 control-label">NoteBridgeId</label>
							<div class="col-sm-10">
								<input type="noteBridgeId" class="form-control" id="inputBridgeId" placeholder="NoteBridgeId">
							</div>
						</div>
						<div class="form-group">
						<label for class="textarea" class="col-lg-10 control-label">   Note</label>
						<div class="col-lg-10">
							<textarea rows="5" cols="100">Note Content</textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-10">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
	</form>
	</div>
	<!--- Date Picker  Special Version of Bootstrap that only a---------->
	<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

	<!-- Font Awesome (added because you use icons in your prepend/append)-->
	<link rel="stylesheet" href="https://formden.com/static/cdn-awesome/4.4.0/css/font-awesome.min.css"/>

</body>
</html>


