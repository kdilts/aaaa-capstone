import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Placard} from "../classes/placard";
import {Status} from "../classes/status";

@Injectable()
export class PlacardService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private placardUrl = "api/placard/";

	getAllPlacards() : Observable<Placard[]> {
		return(this.http.get(this.placardUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getPlacardByPlacardId(placardId: number) : Observable<Placard> {
		return(this.http.get(this.placardUrl + placardId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getPlacardsByPlacardStatusTypeId(placardStatusTypeId: number) : Observable<Placard[]> {
		return(this.http.get(this.placardUrl + placardStatusTypeId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getPlacardByPlacardNumber(placardNumber: number) : Observable<Placard> {
		return(this.http.get(this.placardUrl + placardNumber)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createPlacard(placard: Placard) : Observable<Status> {
		return(this.http.post(this.placardUrl, placard)
			.map(this.extractMessage)
			.catch(this.handleError));
	}

}