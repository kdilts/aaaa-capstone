import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Application} from "../classes/application";
import {Status} from "../classes/status";

@Injectable()
export class ApplicationService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private applicationUrl = "api/application/";

	getAllApplications() : Observable<Application[]> {
		return(this.http.get(this.applicationUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getAllApplicationsAndCohorts(getAllCohortsToo: boolean) : Observable<any[]> {
		return(this.http.get(this.applicationUrl + getAllCohortsToo)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getApplicationsByApplicationDateRange(startDate: string, endDate: string) : Observable<Application[]> {
		return(this.http.get(this.applicationUrl + startDate + endDate)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getApplicationByApplicationEmail(applicationEmail: string) : Observable<Application> {
		return(this.http.get(this.applicationUrl + applicationEmail)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getApplicationByApplicationId(applicationId: number) : Observable<Application> {
		return(this.http.get(this.applicationUrl + applicationId)
			.map(this.extractData)
			.catch(this.handleError));
	}
	getApplicationsByApplicationName(applicationFirstName: string, applicationLastName: string) : Observable<Application[]> {
		return(this.http.get(this.applicationUrl + applicationFirstName + applicationLastName)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createApplication(application: Application) : Observable<Status> {
		return(this.http.post(this.applicationUrl, application)
			.map(this.extractMessage)
			.catch(this.handleError));
	}

}