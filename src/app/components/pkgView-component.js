"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
Object.defineProperty(exports, "__esModule", { value: true });
var core_1 = require("@angular/core");
var router_1 = require("@angular/router");
var application_1 = require("../classes/application");
var application_service_1 = require("../services/application-service");
var cohort_service_1 = require("../services/cohort-service");
var applicationCohort_service_1 = require("../services/applicationCohort-service");
var studentPermit_service_1 = require("../services/studentPermit-service");
var studentPermit_1 = require("../classes/studentPermit");
var PkgViewComponent = (function () {
    function PkgViewComponent(studentPermitService, applicationService, applicationCohortService, cohortService, router, activatedRoute) {
        this.studentPermitService = studentPermitService;
        this.applicationService = applicationService;
        this.applicationCohortService = applicationCohortService;
        this.cohortService = cohortService;
        this.router = router;
        this.activatedRoute = activatedRoute;
        this.application = new application_1.Application(null, "", "", "", "", "", "", "", "", "", "", "", "");
        this.studentPermit = new studentPermit_1.StudentPermit(null, null, null, null, "", "");
        this.studentPermits = [];
        this.applications = [];
        this.applicationCohorts = [];
        this.cohorts = [];
        this.status = null;
    }
    PkgViewComponent.prototype.ngOnInit = function () {
        /*this.reloadStudentPermit();*/
        this.reloadStudentPermits();
        this.reloadApplications();
        this.reloadApplicationCohorts();
        this.reloadCohorts();
    };
    /*reloadStudentPermit()	 : void {
        this.activatedRoute.params
            .switchMap((params : Params) => this.studentPermitService.getStudentPermitByApplicationId(+params["applicationId"]))
            .subscribe(studentPermit => {
                this.studentPermit = studentPermit;
                /!*this.testDate = application.applicationDateTime;*!/
                /!*this.note.noteApplicationId = this.application.applicationId;

                this.noteService.getNotesByNoteApplicationId(this.application.applicationId)
                    .subscribe(notes => this.notes = notes);*!/

                this.applicationCohortService.getApplicationCohortsByApplicationId(this.application.applicationId)
                    .subscribe(applicationCohorts => this.applicationCohorts = applicationCohorts);

            });
    }*/
    PkgViewComponent.prototype.reloadApplications = function () {
        var _this = this;
        this.applicationService.getAllApplications()
            .subscribe(function (applications) { return _this.applications = applications; });
    };
    PkgViewComponent.prototype.reloadApplicationCohorts = function () {
        var _this = this;
        this.applicationCohortService.getAllApplicationCohorts()
            .subscribe(function (applicationCohorts) { return _this.applicationCohorts = applicationCohorts; });
    };
    PkgViewComponent.prototype.reloadCohorts = function () {
        var _this = this;
        this.cohortService.getAllCohorts()
            .subscribe(function (cohorts) { return _this.cohorts = cohorts; });
    };
    PkgViewComponent.prototype.reloadStudentPermits = function () {
        var _this = this;
        this.studentPermitService.getAllStudentPermits()
            .subscribe(function (studentPermits) { return _this.studentPermits = studentPermits; });
    };
    PkgViewComponent.prototype.createStudentPermit = function () {
        var _this = this;
        this.studentPermitService.createStudentPermit(this.studentPermit)
            .subscribe(function (status) {
            _this.status = status;
            if (status.apiStatus === 200) {
                _this.reloadStudentPermits();
                _this.pkgView.reset();
            }
        });
    };
    return PkgViewComponent;
}());
__decorate([
    core_1.ViewChild("pkgView"),
    __metadata("design:type", Object)
], PkgViewComponent.prototype, "pkgView", void 0);
PkgViewComponent = __decorate([
    core_1.Component({
        templateUrl: "./templates/pkgView.php"
    }),
    __metadata("design:paramtypes", [studentPermit_service_1.StudentPermitService,
        application_service_1.ApplicationService,
        applicationCohort_service_1.ApplicationCohortService,
        cohort_service_1.CohortService,
        router_1.Router,
        router_1.ActivatedRoute])
], PkgViewComponent);
exports.PkgViewComponent = PkgViewComponent;
//# sourceMappingURL=pkgView-component.js.map