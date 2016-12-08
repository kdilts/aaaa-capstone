import {Component, OnInit, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {StudentPermitService} from "../services/studentPermit-service";
import {StudentPermit} from "../classes/studentPermit";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/pkgView.php"
})

export class PkgViewComponent implements OnInit{
	@ViewChild("pkgView") pkgView : any;
	studentPermits : StudentPermit[] = [];
	status: Status = null;

	constructor(
		private studentPermitService: StudentPermitService,
		private router: Router
	) {}

	ngOnInit() : void {
		this.reloadStudentPermits();
	}

	reloadStudentPermits()	 : void {
		this.studentPermitService.getAllStudentPermits()
			.subscribe(studentPermits => this.studentPermits = studentPermits);
	}

}