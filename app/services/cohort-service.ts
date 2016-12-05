import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Cohort} from "../classes/cohort";
import {Status} from "../classes/status";

@Injectable()
export class CohortService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private cohortUrl = "api/cohort/";

	getAllCohorts() : Observable<Cohort[]> {
		return(this.http.get(this.cohortUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getCohortByCohortId(cohort: number) : Observable<Cohort> {
		return(this.http.get(this.cohortUrl + cohortId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getCohortByCohortName(cohortName: string) : Observable<Cohort> {
		return(this.http.get(this.cohortUrl + cohortName)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createCohort(cohort: Cohort) : Observable<Status> {
		return(this.http.post(this.cohortUrl, cohort)
			.map(this.extractMessage)
			.catch(this.handleError));
	}

}