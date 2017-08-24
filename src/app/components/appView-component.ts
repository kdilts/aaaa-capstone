import {Component, OnInit, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {Application} from "../classes/application";

import {Cohort} from "../classes/cohort";
import {ApplicationCohort} from "../classes/applicationCohort";
import {ApplicationCohortService} from "../services/applicationCohort-service";
import {Status} from "../classes/status";
import {Subject} from 'rxjs/Subject';
import  "rxjs/operator/debounce";
@Component({
	templateUrl: "./templates/appView.php"
})

export class AppViewComponent implements OnInit{
	@ViewChild("appView") appView : any;
	applications : Application[] = [];
	filteredApplications : ApplicationCohort[] = [];


	applicationCohorts : ApplicationCohort[] = [];
	cohorts : Cohort[] = [];
	status: Status = null;

	//observable used for searching Applications by name
	termStream = new Subject<string>();

	application : Application = new Application(null,null, null, null, null, null, null, null, null, null, null, null, null);

	constructor(private applicationCohortService: ApplicationCohortService, private router: Router) {
		this.termStream
			.subscribe(term  => this.filterApplicationByName(term));
	}

	ngOnInit() : void {
		this.reloadApplicationCohorts();
	}

	reloadApplicationCohorts()	 : void {
		this.applicationCohortService.getAllApplicationCohorts()
			.subscribe(applicationCohorts => this.applicationCohorts = applicationCohorts);

	}

	switchApplication(application: Application) : void {
		this.router.navigate(["/detailView/", application.applicationId]);
	}

	filterApplicationByName(term : string ) : void {
		this.applicationCohortService.getApplicationCohortsByApplicationName(term)
			.debounceTime(30000)
			.subscribe(applicationCohort => {
				this.applicationCohorts = applicationCohort;
				if (this.filteredApplications !== null) {
					console.log("I work");
					console.log(this.applicationCohorts);
				}
			});
	}
}