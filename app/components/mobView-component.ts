import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute} from "@angular/router";
import {ProspectService} from "../services/prospect-service";
import {Status} from "../classes/status";
import {Prospect} from "../classes/prospect";
import {Cohort} from "../classes/cohort";
import {CohortService} from "../services/cohort-service";


@Component({
	templateUrl: "./templates/mobView.php"
})

export class MobViewComponent implements OnInit{
	@ViewChild("quickProspectForm") quickProspectForm : any;
	prospect : Prospect = new Prospect(0, "", "", "", "");
	status: Status = null;
	cohorts: Cohort[] = [];

	constructor(
		private cohortService: CohortService,
		private prospectService: ProspectService,
		private router: Router
	) {}

	ngOnInit() : void {
		this.reloadCohorts();
	}

	reloadCohorts() : void {
		this.cohortService.getAllCohorts()
			.subscribe(cohorts => this.cohorts = cohorts);
	}

	createProspect() : void {
		this.prospectService.createProspect(this.prospect)
			.subscribe(status => {
				this.status = status;
				if(status.apiStatus === 200) {
					this.quickProspectForm.reset();
				}
			});
	}

}
