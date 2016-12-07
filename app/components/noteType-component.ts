import {Component, OnInit, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {NoteType} from "../classes/noteType";
import {NoteTypeService} from "../services/noteType-service";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/noteType.php"
})

export class NoteTypeComponent implements OnInit {
	@ViewChild("noteTypeForm") noteTypeForm;
	noteTypes : NoteType[] = [];
	NoteType : NoteType = new NoteType(null, "");
	status: Status = null;

	constructor(private noteTypeService: NoteTypeService, private router: Router) {}

	ngOnInit() : void {
		this.getAllNoteTypes();
	}

	getAllNoteTypes() : void {
		this.noteTypeService.getAllNoteType()
			.subscribe(noteTypes => this.noteTypes = noteTypes);
	}

	reloadNoteTypes() : void {
		this.noteTypeService.getAllNoteType()
			.subscribe(noteTypes => this.noteTypes = noteTypes);
	}

	createNoteType() : void {
		this.noteTypeService.createNoteType(this.NoteType)
			.subscribe(status => {
				this.status = status;
				if(status.status === 200) {
					this.reloadNoteTypes();
					this.noteTypeForm.reset();
				}
			});
	}

}