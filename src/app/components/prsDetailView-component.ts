import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute, Params} from "@angular/router";
import {NgForm} from "@angular/forms";
import {ProspectService} from "../services/prospect-service";
import {ProspectCohortService} from "../services/prospectCohort-service";
import {Note} from "../classes/note";
import {NoteService} from "../services/note-service";
import {Prospect} from "../classes/prospect";
import {ProspectCohort} from "../classes/prospectCohort";
import {NoteType} from "../classes/noteType";
import {NoteTypeService} from "../services/noteType-service";
import {Status} from "../classes/status";

import 'rxjs/add/operator/switchMap';

@Component({
	templateUrl: "./templates/prsDetailView.php"
})

export class PrsDetailViewComponent implements OnInit{
	@ViewChild("prsDetailView") prsDetailView : any;
	prospect : Prospect = new Prospect(null, "", "", "", "");
	prospectCohorts : ProspectCohort[] = [];
	notes : Note[] = [];
	note : Note = new Note(null, null, null, null, "", "");
	status: Status = null;
	noteTypes: NoteType[] = [];
	noteNoteType: NoteType = null;


	constructor(
		private prospectService: ProspectService,
		private prospectCohortService: ProspectCohortService,
		private noteService: NoteService,
		private noteTypeService: NoteTypeService,
		private router: Router,
		private activatedRoute: ActivatedRoute
	) {}

	ngOnInit() : void {
		this.reloadProspect();
		this.reloadNoteTypes();
	}


	reloadProspect()	 : void {

		this.activatedRoute.params
			.switchMap((params : Params) => this.prospectService.getProspectByProspectId(+params["prospectId"]))
			.subscribe(prospect => {
				//this.prospect = prospect[0];
				this.prospect = prospect;
				console.log(this.prospect);
				this.note.noteProspectId = this.prospect.prospectId;


				this.noteService.getNotesByNoteProspectId(this.prospect.prospectId)
					.subscribe(notes => this.notes = notes.reverse());

				this.prospectCohortService.getProspectCohortsByProspectId(this.prospect.prospectId)
					.subscribe(prospectCohorts => this.prospectCohorts = prospectCohorts);


			});
	}
	reloadNoteTypes() : void {
		this.noteTypeService.getAllNoteTypes()
			.subscribe(noteTypes => this.noteTypes = noteTypes);

	}

	createNote() : void {
		this.noteService.createNote(this.note)
			.subscribe(status => {
				this.status = status;
				if(status.apiStatus === 200) {
					this.reloadProspect();
					this.prsDetailView.reset();
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