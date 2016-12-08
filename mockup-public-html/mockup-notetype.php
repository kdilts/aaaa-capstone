<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<script data-require="jquery@2.2.0" data-semver="2.2.0"
				  src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6"
				  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="style.css"/>
		<script src="script.js"></script>

		<title>Note Type</title>
	</head>
	<body>
		<section>
			<div class="container">
				<div class="jumbotron text-center">
					<h1>Stream Line CNM</h1>
					<h1>Note Type</h1>
				</div>
			</div>
		</section>
		<div class="list-group">
			<div>
				<div class="col-sm-6">
					<form class="form-horizontal">
						<div class="form-group">
							<div class="form-group">
								<label for="noteTypeId" class="col-sm-6 control-label">Note Type Id</label>
								<div class="col-sm-10">
									<input type="noteTypeId" class="form-control" id="inputNoteTypeId" placeholder="NoteTypeId">
								</div>
							</div>
							<div class="form-group">
								<label for="inputNoteTypeName" class="col-sm-6 control-label">Note Type Name</label>
								<div class="col-sm-10">
									<input type="noteTypeName" class="form-control" id="inputNoteTypeName" placeholder="Note Type Name">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default">Submit</button>
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</body>



</html>