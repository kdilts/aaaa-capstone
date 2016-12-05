import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {ApplicationCohort} from "../classes/applicationCohort";
import {Status} from "../classes/status";

@Injectable()
export class ApplicationCohortService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private applicationCohortUrl = "api/applicationCohort/";

	getAllApplicationCohorts() : Observable<ApplicationCohort[]> {
		return(this.http.get(this.applicationCohortUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getApplicationCohortsByApplicationId(applicationCohortApplicationId: number) : Observable<ApplicationCohort[]> {
		return(this.http.get(this.applicationCohortUrl + applicationCohortApplicationId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getApplicationCohortsByCohortId(applicationCohortCohortId: number) : Observable<ApplicationCohort[]> {
		return(this.http.get(this.applicationCohortUrl + applicationCohortCohortId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getApplicationCohort(applicationCohortId: number) : Observable<ApplicationCohort> {
		return(this.http.get(this.applicationCohortUrl + applicationCohortId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createNoteType(applicationCohort: ApplicationCohort) : Observable<Status> {
		return(this.http.post(this.applicationCohortUrl, applicationCohort)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
	
}