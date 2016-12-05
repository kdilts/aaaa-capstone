import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {ProspectCohort} from "../classes/prospectCohort";
import {Status} from "../classes/status";

@Injectable()
export class ProspectCohortService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private prospectCohortUrl = "api/prospectCohort/";

	getAllProspectCohorts() : Observable<ProspectCohort[]> {
		return(this.http.get(this.prospectCohortUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getProspectCohortsByProspectId(prospectCohortProspectId: number) : Observable<ProspectCohort[]> {
		return(this.http.get(this.prospectCohortUrl + prospectCohortProspectId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getProspectCohortsByCohortId(prospectCohortCohortId: number) : Observable<ProspectCohort[]> {
		return(this.http.get(this.prospectCohortUrl + prospectCohortCohortId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getProspectCohort(prospectCohortId: number) : Observable<ProspectCohort> {
		return(this.http.get(this.prospectCohortUrl + prospectCohortId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createNoteType(prospectCohort: ProspectCohort) : Observable<Status> {
		return(this.http.post(this.prospectCohortUrl, prospectCohort)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
	
}