<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
if(empty($_SESSION["adUser"]) === false) { ?>
<div class="text-center">
<h1>Note Type</h1>
</div>
<div class="note-type container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">

<ul>
	<li  *ngFor="let noteType of noteTypes">
		{{ noteType.noteTypeId }} : {{ noteType.noteTypeName }}
	</li>
</ul>


<form #noteTypeForm="ngForm" name="noteTypeForm" id="noteTypeForm" class="form-horizontal well" (ngSubmit)="createNoteType();" novalidate>
	<h2>Create NoteType</h2>
	<hr/>
	<div class="form-group" [ngClass]="{ 'has-error': noteTypeName.touched && noteTypeName.invalid }">
		<label for="noteType">NoteType</label>
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-comment" aria-hidden="true"></i>
			</div>
			<input type="text" name="noteTypeName" id="noteTypeName" class="form-control" maxlength="30" required [(ngModel)]="noteType.noteTypeName" #noteTypeName="ngModel" />
		</div>
		<div [hidden]="noteTypeName.valid || noteTypeName.pristine" class="alert alert-danger" role="alert">
			<p *ngIf="noteTypeName.errors?.required">NoteType is required.</p>
			<p *ngIf="noteTypeName.errors?.maxlength">NoteType is too long.</p>
		</div>
	</div>
	<button type="submit" class="btn btn-info btn-lg" [disabled]="noteTypeForm.invalid"><i class="fa fa-share"></i> NoteType</button>
	<button type="reset" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Cancel</button>
</form>

<div *ngIf="status !== null" class="alert alert-dismissible" [ngClass]="status.type" role="alert">
	<button type="button" class="close" aria-label="Close" (click)="status = null;"><span aria-hidden="true">&times;</span></button>
	{{ status.message }}
</div>
<?php } else {
	require(dirname(__DIR__) . "/templates/loginView.php");
}