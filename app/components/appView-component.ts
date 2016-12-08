import {Component, OnInit, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {ApplicationService} from "../services/application-service";
import {ProspectService} from "../services/prospect-service";
import {Application} from "../classes/application";
import {Prospect} from "../classes/prospect";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/appView.php"
})

export class AppViewComponent implements OnInit{
	@ViewChild("appView") appView : any;
	applications : Application[] = [];
	prospects : Prospect[] = [];
	status: Status = null;

	constructor(
		private applicationService: ApplicationService,
		private prospectService: ProspectService,
		private router: Router
	) {}

	ngOnInit() : void {
		this.reloadApplications();
		this.reloadProspects();
	}

	reloadApplications()	 : void {
		this.applicationService.getAllApplications()
			.subscribe(applications => this.applications = applications);
	}

	reloadProspects() : void {
		this.prospectService.getAllProspects()
			.subscribe(prospects => this.prospects = prospects);
	}

}