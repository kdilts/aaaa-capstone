import {Component, OnInit, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {Application} from "../classes/application";
import {ApplicationService} from "../services/application-service";
import {Prospect} from "../classes/prospect";
import {ProspectService} from "../services/prospect-service";
import {Cohort} from "../classes/cohort";
import {CohortService} from "../services/cohort-service";
import {ApplicationCohort} from "../classes/applicationCohort";
import {ApplicationCohortService} from "../services/applicationCohort-service";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/appView.php"
})

export class AppViewComponent implements OnInit{
	@ViewChild("appView") appView : any;
	applications : Application[] = [];
	objects : any[] = [];
	prospects : Prospect[] = [];
	applicationCohorts : ApplicationCohort[] = [];
	cohorts : Cohort[] = [];
	status: Status = null;

	constructor(
		private applicationService: ApplicationService,
		private prospectService: ProspectService,
		private applicationCohortService: ApplicationCohortService,
		private cohortService: CohortService,
		private router: Router
	) {}

	ngOnInit() : void {
		this.reloadApplications();
		this.reloadProspects();
		this.reloadApplicationCohorts();
		this.reloadCohorts();
	}

	reloadApplications()	 : void {
		this.applicationService.getAllApplications()
			.subscribe(applications => this.applications = applications);
	}

	reloadProspects() : void {
		this.prospectService.getAllProspects()
			.subscribe(prospects => this.prospects = prospects);
	}

	reloadApplicationCohorts()	 : void {
		this.applicationCohortService.getAllApplicationCohorts()
			.subscribe(applicationCohorts => this.applicationCohorts = applicationCohorts);
	}

	reloadCohorts() : void {
		this.cohortService.getAllCohorts()
			.subscribe(cohorts => this.cohorts = cohorts);
	}

}