<h1>Note Type</h1>

<ul>
	<li *ngFor="let noteType of noteTypes">
		{{ noteType.noteTypeName }}
	</li>
</ul>

<form action="../api/noteType/index.php" method="post">
	<label>Note Type Name:</label>
	<input name="noteTypeName" type="text"/>
	<button type="submit">Submit</button>
</form>