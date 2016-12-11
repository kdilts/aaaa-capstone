import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute} from "@angular/router";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/loginView.php"
})

export class LoginViewComponent implements OnInit{
	@ViewChild("loginView") loginView : any;
	status: Status = null;

	constructor(
		private router: Router,
		private route: ActivatedRoute
	) {}

	ngOnInit() : void {
	}

}