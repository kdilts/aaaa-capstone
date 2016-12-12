import {Component, OnInit, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {ProspectService} from "../services/prospect-service";
import {Status} from "../classes/status";
import {Prospect} from "../classes/prospect";

@Component({
	templateUrl: "./templates/mobView.php"
})

export class MobViewComponent {
	@ViewChild("mobView") mobView : any;
	prospect : Prospect = new Prospect(0, "", "", "", "");
	status: Status = null;

	constructor(
		private prospectService: ProspectService,
		private router: Router
	) {}



}
