import {Component, OnInit, Output, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {NgForm} from "@angular/forms";
import {ApplicationService} from "../services/application-service";
import {Application} from "../classes/application";
import {EventEmitter} from "@angular/core";
import {NoteType} from "../classes/noteType";
import {NoteTypeService} from "../services/noteType-service";
import 'rxjs/add/operator/switchMap';

@Component({
	selector: "navbar",
	templateUrl: "./templates/navbar.php"
})

export class NavbarComponent implements OnInit {

	@Output() open: EventEmitter<any> = new EventEmitter();
	@Output() close: EventEmitter<any> = new EventEmitter();
	noteTypes: NoteType[] = [];

	searchResults: Application[] = []; // search results

	ApplicationLastName: string = "";
	ApplicationFirstName: string = "";

	applicationResults: Application;

	constructor(/*private applicationService: ApplicationService, */private noteTypeService: NoteTypeService) {

	}

	ngOnInit() : void {
		//this.applicationService.getAllApplications();
		this.reloadNoteTypes();
	}
	reloadNoteTypes() : void {
		this.noteTypeService.getAllNoteTypes()
			.subscribe(noteTypes => this.noteTypes = noteTypes);
	}

/*	searchForApplicationLastName(): void {
		this.applicationService.getApplicationByApplicationLastName(this.ApplicationLastName).subscribe(Application=>this.searchResults = Application);
	}

	searchForApplicationFirstName(): void {
		this.applicationService.getApplicationsByApplicationFirstName(this.ApplicationFirstName).subscribe(Application=>this.searchResults = Application);
	}*/
}
