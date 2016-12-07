<h1>Note Type</h1>

<ul>
	<li *ngFor="let noteType of noteTypes">
		{{ noteType.noteTypeName }}
	</li>
</ul>

<form #noteTypeForm="ngForm" name="noteTypeForm" id="noteTypeForm" class="form-horizontal well" (ngSubmit)="createNoteType();" novalidate>
	<h2>Create NoteType</h2>
	<hr />
	<div class="form-group" [ngClass]="{ 'has-error': noteType.touched && noteType.invalid }">
		<label for="noteType">NoteType</label>
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-comment" aria-hidden="true"></i>
			</div>
			<input type="text" name="noteType" id="noteType" class="form-control" maxlength="255" required [(ngModel)]="noteType.noteType" #noteTypeText="ngModel" />
		</div>
		<div [hidden]="noteTypeText.valid || noteTypeText.pristine" class="alert alert-danger" role="alert">
			<p *ngIf="noteTypeText.errors?.required">NoteType is required.</p>
			<p *ngIf="noteTypeText.errors?.maxlength">NoteType is too long. You typed</p>
		</div>
	</div>
	<button type="submit" class="btn btn-info btn-lg" [disabled]="noteTypeForm.invalid"><i class="fa fa-share"></i> NoteType</button>
	<button type="reset" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Cancel</button>
</form>

<div *ngIf="status !== null" class="alert alert-dismissible" [ngClass]="status.type" role="alert">
	<button type="button" class="close" aria-label="Close" (click)="status = null;"><span aria-hidden="true">&times;</span></button>
	{{ status.message }}
</div>