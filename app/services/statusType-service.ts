import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {StatusType} from "../classes/statusType";
import {Status} from "../classes/status";

@Injectable()
export class StatusTypeService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private statusTypeUrl = "api/statusType/";

	getAllStatusType() : Observable<StatusType[]> {
		return(this.http.get(this.statusTypeUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getStatusTypesByStatusTypeName(statusTypeName: number) : Observable<StatusType[]> {
		return(this.http.get(this.statusTypeUrl + statusTypeName)
			.map(this.extractData)
			.catch(this.handleError));
	}
	
	getStatusType(statusTypeId: number) : Observable<StatusType> {
		return(this.http.get(this.statusTypeUrl + statusTypeId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createStatusType(statusType: StatusType) : Observable<Status> {
		return(this.http.post(this.statusTypeUrl, statusType)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
	
}