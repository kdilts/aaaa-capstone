<div class="row">
	<div class="col-xs-12">
		<form #loginForm="ngForm" name="loginForm" id="loginForm" class="form-horizontal well" (ngSubmit)="login();" novalidate>

			<div class="form-group" [ngClass]="{ 'has-error': userName.touched && userName.invalid }">
				<label for="userName">User Name: </label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-comment" aria-hidden="true"></i>
					</div>
					<input type="text" name="userName" id="userName" class="form-control" maxlength="255" required [(ngModel)]="loginData.userName" #userNameText="ngModel" />
				</div>
				<div [hidden]="userNameText.valid || userNameText.pristine" class="alert alert-danger" role="alert">
					<p *ngIf="userNameText.errors?.required">User Name is required.</p>
					<p *ngIf="userNameText.errors?.maxlength">User Name is too long.</p>
				</div>
			</div>

<!--			<div class="form-group" [ngClass]="{ 'has-error': password.touched && password.invalid }">-->
<!--				<label for="password">Password</label>-->
<!--				<div class="input-group">-->
<!--					<div class="input-group-addon">-->
<!--						<i class="fa fa-comment" aria-hidden="true"></i>-->
<!--					</div>-->
<!--					<input type="text" name="password" id="password" class="form-control" maxlength="255" required [(ngModel)]="loginForm.password" #passwordText="ngModel" />-->
<!--				</div>-->
<!--				<div [hidden]="passwordText.valid || passwordText.pristine" class="alert alert-danger" role="alert">-->
<!--					<p *ngIf="passwordText.errors?.required">Password is required.</p>-->
<!--					<p *ngIf="passwordText.errors?.maxlength">Password is too long.</p>-->
<!--				</div>-->
<!--			</div>-->

			<button type="submit" class="btn btn-info btn-lg" [disabled]="loginForm.invalid"><i class="fa fa-share"></i> Login</button>
			<button type="reset" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Reset</button>

		</form>
	</div>
</div>