import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {ActiveDirectory} from "../classes/activeDirectory";
import {Status} from "../classes/status";

@Injectable()
export class ActiveDirectoryService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private activeDirectoryUrl = "api/activeDirectory/";

	login(loginData: ActiveDirectory) : Observable<Status> {
		return(this.http.post(this.activeDirectoryUrl, loginData)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
}