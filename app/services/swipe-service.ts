import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Swipe} from "../classes/swipe";
import {Status} from "../classes/status";

@Injectable()
export class SwipeService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private swipeUrl = "api/swipe/";

	getAllSwipes() : Observable<Swipe[]> {
		return(this.http.get(this.swipeUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getSwipeBySwipeId(swipeId: number) : Observable<Swipe> {
		return(this.http.get(this.swipeUrl + swipeId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getSwipesBySwipeStatusTypeId(swipeStatusTypeId: number) : Observable<Swipe[]> {
		return(this.http.get(this.swipeUrl + swipeStatusTypeId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getSwipeBySwipeNumber(swipeNumber: number) : Observable<Swipe> {
		return(this.http.get(this.swipeUrl + swipeNumber)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createSwipe(Swipe: Swipe) : Observable<Status> {
		return(this.http.post(this.swipeUrl, swipe)
			.map(this.extractMessage)
			.catch(this.handleError));
	}

}