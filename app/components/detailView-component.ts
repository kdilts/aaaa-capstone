import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute, Params} from "@angular/router";
import {NgForm} from "@angular/forms";
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
	@ViewChild("detailView") detailView : any;
	application : Application = new Application(null, "", "", "", "", "", "", "", "", "", "", "", "");
	applicationCohorts : ApplicationCohort[] = [];
	notes : Note[] = [];
	note : Note = new Note(null, 0, 0, 0, "", "", "");
	status: Status = null;

	constructor(
		private applicationService: ApplicationService,
		private applicationCohortService: ApplicationCohortService,
		private noteService: NoteService,
		private router: Router,
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

				alert(this.application.applicationId);
				alert(this.applicationCohortService.getAllApplicationCohorts());
			});
	}

	createNote() : void {
		this.noteService.createNote(this.note)
			.subscribe(status => {
				this.status = status;
				if(status.apiStatus === 200) {
					this.reloadApplication();
					this.detailView.reset();
				}
			});
	}

}
// export class SimpleFormComp {
// 	onSubmit(f: NgForm) {
// 		console.log(f.value);  // { first: '', last: '' }
// 		console.log(f.valid);  // false
// 	}
// }