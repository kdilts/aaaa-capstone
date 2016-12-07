import {Component, OnInit} from "@angular/core";
import {Router} from "@angular/router";
import {NoteType} from "../classes/noteType";
import {NoteTypeService} from "../services/noteType-service";

@Component({
	templateUrl: "./templates/noteType.php"
})

export class NoteTypeComponent implements OnInit {
	private noteTypes : NoteType[] = [];

	constructor(private noteTypeService: NoteTypeService, private router: Router) {}

	ngOnInit() : void {
		this.getAllNoteTypes();
	}

	getAllNoteTypes() : void {
		this.noteTypeService.getAllNoteType()
			.subscribe(noteTypes => this.noteTypes = noteTypes);
	}


}