import {Component, OnInit, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {ApplicationService} from "../services/application-service";
import {ProspectService} from "../services/prospect-service";
import {NoteService} from "../services/note-service";
import {Application} from "../classes/application";
import {Prospect} from "../classes/prospect";
import {Status} from "../classes/status";
import {Note} from "../classes/note";

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
		private router: Router,
		private application: Application
	) {}

	ngOnInit() : void {
		this.reloadApplications();
		this.reloadProspects();
		this.reloadNotes();
	}

	reloadApplications()	 : void {
		this.applicationService.getApplicationByApplicationId()
			.subscribe(application => this.application = application);
	}

	reloadProspects() : void {
		this.prospectService.getAllProspects()
			.subscribe(prospects => this.prospects = prospects);
	}

	reloadNotes() : void {
		this.noteService.getNotesByNoteApplicationId()
			.subscribe(notes => this.notes = notes);
	}
}
