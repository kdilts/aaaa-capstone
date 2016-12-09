import {Component, OnInit, ViewChild} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {ApplicationService} from "../services/application-service";
import {ProspectService} from "../services/prospect-service";
import {NoteService} from "../services/note-service";
import {Application} from "../classes/application";
import {Prospect} from "../classes/prospect";
import {Status} from "../classes/status";
import {Note} from "../classes/note";
import 'rxjs/add/operator/switchMap';

@Component({
	templateUrl: "./templates/detailView.php"
})

export class DetailViewComponent implements OnInit{
	@ViewChild("detailView") detailView : any;
	applications : Application[] = [];
	prospects : Prospect[] = [];
	notes : Note[] = [];
	status: Status = null;

	constructor(
		private applicationService: ApplicationService,
		private prospectService: ProspectService,
		private noteService: NoteService,
		private activatedRoute: ActivatedRoute,
		private application: Application
	) {}

	ngOnInit() : void {
		this.reloadApplications();
		this.reloadProspects();
	}

	reloadApplications()	 : void {
		this.activatedRoute.params
			.switchMap((params : Params) => this.applicationService.getApplicationByApplicationId(+params["applicationId"]))
			.subscribe(application => {
				this.application = application;
				this.noteService.getNotesByNoteApplicationId(this.application.applicationId)
					.subscribe(notes => this.notes = notes);
			});
	}

	reloadProspects() : void {
		this.prospectService.getAllProspects()
			.subscribe(prospects => this.prospects = prospects);
	}
}
