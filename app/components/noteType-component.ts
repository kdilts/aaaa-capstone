import {Component, OnInit, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {NoteTypeService} from "../services/noteType-service";
import {NoteType} from "../classes/noteType";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/noteType.php"
})

export class NoteTypeComponent implements OnInit {
	@ViewChild("noteTypeForm") noteTypeForm : any;
	noteTypes : NoteType[] = [];
	noteType : NoteType = new NoteType(null, "");
	status: Status = null;

	constructor(
		private noteTypeService: NoteTypeService,
		private router: Router
	) {}

	ngOnInit() : void {
		this.reloadNoteTypes();
	}

	reloadNoteTypes() : void {
		this.noteTypeService.getAllNoteType()
			.subscribe(noteTypes => this.noteTypes = noteTypes);
	}

	createNoteType() : void {
		this.noteTypeService.createNoteType(this.noteType)
			.subscribe(status => {
				this.status = status;
				if(status.apiStatus === 200) {
					this.reloadNoteTypes();
					this.noteTypeForm.reset();
				}
			});
	}

}