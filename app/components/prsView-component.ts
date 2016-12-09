import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute} from "@angular/router";
import {Prospect} from "../classes/prospect";
import {ProspectService} from "../services/prospect-service";
import {Cohort} from "../classes/cohort";
import {CohortService} from "../services/cohort-service";
import {ProspectCohort} from "../classes/prospectCohort";
import {ProspectCohortService} from "../services/prospectCohort-service";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/prsView.php"
})

export class PrsViewComponent implements OnInit{
	@ViewChild("prsView") prsView : any;
	prospects : Prospect[] = [];
	prospectCohorts : ProspectCohort[] = [];
	cohorts : Cohort[] = [];
	status: Status = null;

	constructor(
		private prospectService: ProspectService,
		private prospectCohortService: ProspectCohortService,
		private cohortService: CohortService,
		private router: Router,
		private route: ActivatedRoute
	) {}

	ngOnInit() : void {
		this.reloadProspects();
		this.reloadProspectCohorts();
		this.reloadCohorts();
	}

	reloadProspects() : void {
		this.prospectService.getAllProspects()
			.subscribe(prospects => this.prospects = prospects);
	}

	reloadProspectCohorts()	 : void {
		this.prospectCohortService.getAllProspectCohorts()
			.subscribe(prospectCohorts => this.prospectCohorts = prospectCohorts);
	}

	reloadCohorts() : void {
		this.cohortService.getAllCohorts()
			.subscribe(cohorts => this.cohorts = cohorts);
	}
	
}