import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Bridge} from "../classes/bridge";
import {Status} from "../classes/status";

@Injectable()
export class BridgeService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private bridgeUrl = "api/bridge/";

	getAllBridges() : Observable<Bridge[]> {
		return(this.http.get(this.bridgeUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getBridgeByBridgeStaffId(bridgeStaffId: string) : Observable<Bridge> {
		return(this.http.get(this.bridgeUrl + bridgeStaffId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getBridgeByBridgeName(bridgeName: string) : Observable<Bridge> {
		return(this.http.get(this.bridgeUrl + bridgeName)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getBridgeByBridgeUserName(bridgeUserName: string) : Observable<Bridge> {
		return(this.http.get(this.bridgeUrl + bridgeUserName)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createBridge(bridge: Bridge) : Observable<Status> {
		return(this.http.post(this.bridgeUrl, bridge)
			.map(this.extractMessage)
			.catch(this.handleError));
	}

}