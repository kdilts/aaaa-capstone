import {Component, OnInit, ViewChild} from "@angular/core";
import {Status} from "../classes/status";
import {ActiveDirectoryService} from "../services/activeDirectory-service"
import {ActiveDirectory} from "../classes/activeDirectory";

@Component({
	templateUrl: "./templates/loginView.php"
})

export class LoginViewComponent {
	@ViewChild("loginForm") loginForm;
	loginData : ActiveDirectory = new ActiveDirectory("", "");
	status: Status = null;

	constructor(private activeDirectoryService: ActiveDirectoryService) {}

	login() : void {
		this.activeDirectoryService.login(this.loginData)
			.subscribe(status => {
				this.status = status;
				if(status.apiStatus === 200) {
					this.loginForm.reset();
				}
			});
	}
}