import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute, Params} from "@angular/router";
import {NgForm} from "@angular/forms";
import {Application} from "../classes/application";
import {ApplicationService} from "../services/application-service";
import {Cohort} from "../classes/cohort";
import {CohortService} from "../services/cohort-service";
import {ApplicationCohort} from "../classes/applicationCohort";
import {ApplicationCohortService} from "../services/applicationCohort-service";
import {StudentPermitService} from "../services/studentPermit-service";
import {StudentPermit} from "../classes/studentPermit";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/pkgView.php"
})

export class PkgViewComponent implements OnInit{
	@ViewChild("pkgView") pkgView : any;
	application : Application = new Application(null, "", "", "", "", "", "", "", "", "", "", "", "");
	studentPermit : StudentPermit = new StudentPermit(null, null, null, null, "", "");
	studentPermits : StudentPermit[] = [];
	applications: Application[] = [];
	applicationCohorts : ApplicationCohort[] = [];
	cohorts : Cohort[] = [];
	status: Status = null;

	constructor(
		private studentPermitService: StudentPermitService,
		private applicationService: ApplicationService,
		private applicationCohortService: ApplicationCohortService,
		private cohortService: CohortService,
		private router: Router,
		private activatedRoute: ActivatedRoute
	) {}

	ngOnInit() : void {
		/*this.reloadStudentPermit();*/
		this.reloadStudentPermits();
		this.reloadApplications();
		this.reloadApplicationCohorts();
		this.reloadCohorts();
	}
	/*reloadStudentPermit()	 : void {
		this.activatedRoute.params
			.switchMap((params : Params) => this.studentPermitService.getStudentPermitByApplicationId(+params["applicationId"]))
			.subscribe(studentPermit => {
				this.studentPermit = studentPermit;
				/!*this.testDate = application.applicationDateTime;*!/
				/!*this.note.noteApplicationId = this.application.applicationId;

				this.noteService.getNotesByNoteApplicationId(this.application.applicationId)
					.subscribe(notes => this.notes = notes);*!/

				this.applicationCohortService.getApplicationCohortsByApplicationId(this.application.applicationId)
					.subscribe(applicationCohorts => this.applicationCohorts = applicationCohorts);

			});
	}*/
	reloadApplications()	 : void {
		this.applicationService.getAllApplications()
			.subscribe(applications => this.applications = applications);
	}

	reloadApplicationCohorts()	 : void {
		this.applicationCohortService.getAllApplicationCohorts()
			.subscribe(applicationCohorts => this.applicationCohorts = applicationCohorts);
	}

	reloadCohorts() : void {
		this.cohortService.getAllCohorts()
			.subscribe(cohorts => this.cohorts = cohorts);
	}
	reloadStudentPermits()	 : void {
		this.studentPermitService.getAllStudentPermits()
			.subscribe(studentPermits => this.studentPermits = studentPermits);
	}
	createStudentPermit() : void {
		this.studentPermitService.createStudentPermit(this.studentPermit)
			.subscribe(status => {
				this.status = status;
				if(status.apiStatus === 200) {
					this.reloadStudentPermits();
					this.pkgView.reset();
				}
			});
	}
}