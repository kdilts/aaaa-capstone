import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {StudentPermit} from "../classes/studentPermit";
import {Status} from "../classes/status";

@Injectable()
export class StudentPermitService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private studentPermitUrl = "api/studentPermit/";

	getAllStudentPermit() : Observable<StudentPermit[]> {
		return(this.http.get(this.studentPermitUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	// TODO verify date range functions
	getStudentPermitsByCheckInDateRange(startDate: string, endDate: string) : Observable<StudentPermit[]> {
		return(this.http.get(this.studentPermitUrl + startDate + endDate)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getStudentPermitsByCheckOutDateRange(startDate: string, endDate: string) : Observable<StudentPermit[]> {
		return(this.http.get(this.studentPermitUrl + startDate + endDate)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getStudentPermitByPlacardId(studentPermitPlacardId: number) : Observable<StudentPermit> {
		return(this.http.get(this.studentPermitUrl + studentPermitPlacardId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getStudentPermitBySwipeId(studentPermitSwipeId: number) : Observable<StudentPermit> {
		return(this.http.get(this.studentPermitUrl + studentPermitSwipeId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getStudentPermitByApplicationId(studentPermitApplicationId: number) : Observable<StudentPermit> {
		return(this.http.get(this.studentPermitUrl + studentPermitApplicationId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getStudentPermit(studentPermitId: number) : Observable<StudentPermit> {
		return(this.http.get(this.studentPermitUrl + studentPermitId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createStudentPermit(studentPermit: StudentPermit) : Observable<Status> {
		return(this.http.post(this.studentPermitUrl, studentPermit)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
	
}