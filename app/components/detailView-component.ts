import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";

import {ApplicationService} from "../services/application-service";
import {ApplicationCohortService} from "../services/applicationCohort-service";
import {NoteService} from "../services/note-service";

import {Application} from "../classes/application";
import {ApplicationCohort} from "../classes/applicationCohort";
import {Note} from "../classes/note";

import {Status} from "../classes/status";

import 'rxjs/add/operator/switchMap';

@Component({
	templateUrl: "./templates/detailView.php"
})

export class DetailViewComponent implements OnInit{
	application : Application = new Application(null, "", "", "", "", "", "", "", "", "", "", "", "");
	applicationCohorts : ApplicationCohort[] = [];
	notes : Note[] = [];
	status: Status = null;

	constructor(
		private applicationService: ApplicationService,
		private applicationCohortService: ApplicationCohortService,
		private noteService: NoteService,
		private activatedRoute: ActivatedRoute
	) {}

	ngOnInit() : void {
		this.reloadApplication();
	}

	reloadApplication()	 : void {
		this.activatedRoute.params
			.switchMap((params : Params) => this.applicationService.getApplicationByApplicationId(+params["applicationId"]))
			.subscribe(application => {
				this.application = application;

				this.noteService.getNotesByNoteApplicationId(this.application.applicationId)
					.subscribe(notes => this.notes = notes);

				this.applicationCohortService.getApplicationCohortsByApplicationId(this.application.applicationId)
					.subscribe(applicationCohorts => this.applicationCohorts = applicationCohorts);
			});
	}
}
