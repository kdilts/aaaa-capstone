import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {NoteType} from "../classes/noteType";
import {Status} from "../classes/status";

@Injectable()
export class NoteTypeService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private noteTypeUrl = "api/noteType/";

	getAllNoteTypes() : Observable<NoteType[]> {
		return(this.http.get(this.noteTypeUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getNoteTypesByNoteTypeName(noteTypeName: string) : Observable<NoteType[]> {
		return(this.http.get(this.noteTypeUrl + noteTypeName)
			.map(this.extractData)
			.catch(this.handleError));
	}
	
	getNoteType(noteTypeId: number) : Observable<NoteType> {
		return(this.http.get(this.noteTypeUrl + noteTypeId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createNoteType(noteType: NoteType) : Observable<Status> {
		return(this.http.post(this.noteTypeUrl, noteType)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
	
}