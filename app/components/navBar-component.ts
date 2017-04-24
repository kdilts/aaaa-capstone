import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute} from "@angular/router";
import {ProspectService} from "../services/prospect-service";
import {Status} from "../classes/status";
import {Prospect} from "../classes/prospect";
import {Cohort} from "../classes/cohort";
import {CohortService} from "../services/cohort-service";

@Component({
	selector: "navbar",
	templateUrl: "./templates/navbar.php"
})

export class NavBarComponent {

}
