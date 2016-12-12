<div class="signin-content">
	<div class="row">
		<div class="col-xs-12">
			<form #loginForm="ngForm" name="loginForm" id="loginForm" class="form-horizontal well" (ngSubmit)="login();" novalidate>

				<div class="form-group" [ngClass]="{ 'has-error': userName.touched && userName.invalid }">
					<label for="userName">User Name: </label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<input type="text" name="userName" id="userName" class="form-control" maxlength="255" required [(ngModel)]="loginData.userName" #userName="ngModel" />
					</div>
					<div [hidden]="userName.valid || userName.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="userName.errors?.required">User Name is required.</p>
						<p *ngIf="userName.errors?.maxlength">User Name is too long.</p>
					</div>
				</div>

				<div class="form-group" [ngClass]="{ 'has-error': password.touched && password.invalid }">
					<label for="password">Password</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<input type="password" name="password" id="password" class="form-control" maxlength="255" required [(ngModel)]="loginForm.password" #password="ngModel" />
					</div>
					<div [hidden]="password.valid || password.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="password.errors?.required">Password is required.</p>
						<p *ngIf="password.errors?.maxlength">Password is too long.</p>
					</div>
				</div>

				<button type="submit" class="btn btn-info btn-lg" [disabled]="loginForm.invalid"><i class="fa fa-share"></i> Login</button>
				<button type="reset" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Reset</button>

			</form>
		</div>
	</div>
</div>