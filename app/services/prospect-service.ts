import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Prospect} from "../classes/prospect";
import {Status} from "../classes/status";

@Injectable()
export class ProspectService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private prospectUrl = "api/prospect/";

	getAllProspects() : Observable<Prospect[]> {
		return(this.http.get(this.prospectUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getProspectByProspectId(prospectId: number) : Observable<Prospect> {
		return(this.http.get(this.prospectUrl + prospectId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getProspectByProspectEmail(prospectEmail: string) : Observable<Prospect> {
		return(this.http.get(this.prospectUrl + prospectEmail)
			.map(this.extractData)
			.catch(this.handleError));
	}
//TODO: prospectLastName/FirstName?
	getProspectsByProspectName(prospectFirstName: string, prospectLastName: string) : Observable<Prospect> {
		return(this.http.get(this.prospectUrl + prospectFirstName + prospectLastName)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createProspect(prospect: Prospect) : Observable<Status> {
		return(this.http.post(this.prospectUrl, prospect)
			.map(this.extractMessage)
			.catch(this.handleError));
	}

}