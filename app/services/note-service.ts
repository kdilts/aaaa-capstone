import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Note} from "../classes/note";
import {Status} from "../classes/status";

@Injectable()
export class NoteService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private noteUrl = "api/note/";

	getAllNotes() : Observable<Note[]> {
		return(this.http.get(this.noteUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getNoteByNoteId(noteId: number) : Observable<Note> {
		return(this.http.get(this.noteUrl + noteId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getNotesByNoteApplicationId(noteApplicationId: number) : Observable<Note[]> {
		return(this.http.get(this.noteUrl + "?noteApplicationId=" + noteApplicationId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getNotesByNoteProspectId(noteProspectId: number) : Observable<Note[]> {
		return(this.http.get(this.noteUrl + noteProspectId)
			.map(this.extractData)
			.catch(this.handleError));
	}
	getNotesByNoteNoteTypeId(noteNoteTypeId: number) : Observable<Note[]> {
		return(this.http.get(this.noteUrl + noteNoteTypeId)
			.map(this.extractData)
			.catch(this.handleError));
	}
	getNotesByBridgeStaffId(noteBridgeStaffId: string) : Observable<Note[]> {
		return(this.http.get(this.noteUrl + noteBridgeStaffId)
			.map(this.extractData)
			.catch(this.handleError));
	}
	getNotesByNoteDateRange(startDate: string, endDate: string) : Observable<Note[]> {
		return (this.http.get(this.noteUrl + startDate + endDate)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createNote(note: Note) : Observable<Status> {
		return(this.http.post(this.noteUrl, note)
			.map(this.extractMessage)
			.catch(this.handleError));
	}

}