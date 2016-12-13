<div class="signin-content container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<form #loginForm="ngForm" name="loginForm" id="loginForm" class="form-horizontal well" (ngSubmit)="login();" novalidate>

				<div class="form-group" [ngClass]="{ 'has-error': username.touched && username.invalid }">
					<label for="username">User Name: </label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<input type="text" name="username" id="username" class="form-control" maxlength="255" required [(ngModel)]="loginData.username" #username="ngModel" />
					</div>
					<div [hidden]="username.valid || username.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="username.errors?.required">User Name is required.</p>
						<p *ngIf="username.errors?.maxlength">User Name is too long.</p>
					</div>
				</div>

				<div class="form-group" [ngClass]="{ 'has-error': password.touched && password.invalid }">
					<label for="password">Password:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<input type="password" name="password" id="password" class="form-control" maxlength="255" required [(ngModel)]="loginData.password" #password="ngModel" />
					</div>
					<div [hidden]="password.valid || password.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="password.errors?.required">Password is required.</p>
						<p *ngIf="password.errors?.maxlength">Password is too long.</p>
					</div>
				</div>


				<button type="submit" class="btn btn-info btn-lg" [disabled]="loginForm.invalid"><i class="fa fa-share"></i> Login</button>
				<button type="reset" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Reset</button>

			</form>
			<div *ngIf="status !== null" class="alert alert-dismissible" [ngClass]="status.type" role="alert">
				<button type="button" class="close" aria-label="Close" (click)="status = null;"><span aria-hidden="true">&times;</span></button>
				{{ status.message }}
			</div>
		</div>
	</div>
</div>