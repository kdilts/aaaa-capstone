import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Status} from "../classes/status";

@Injectable()
export class ActiveDirectoryService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private activeDirectoryUrl = "api/activeDirectory/";

}