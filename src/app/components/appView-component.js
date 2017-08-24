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
var applicationCohort_service_1 = require("../services/applicationCohort-service");
var Subject_1 = require("rxjs/Subject");
require("rxjs/operator/debounce");
var AppViewComponent = (function () {
    function AppViewComponent(applicationCohortService, router) {
        var _this = this;
        this.applicationCohortService = applicationCohortService;
        this.router = router;
        this.applications = [];
        this.filteredApplications = [];
        this.applicationCohorts = [];
        this.cohorts = [];
        this.status = null;
        //observable used for searching Applications by name
        this.termStream = new Subject_1.Subject();
        this.application = new application_1.Application(null, null, null, null, null, null, null, null, null, null, null, null, null);
        this.termStream
            .subscribe(function (term) { return _this.filterApplicationByName(term); });
    }
    AppViewComponent.prototype.ngOnInit = function () {
        this.reloadApplicationCohorts();
    };
    AppViewComponent.prototype.reloadApplicationCohorts = function () {
        var _this = this;
        this.applicationCohortService.getAllApplicationCohorts()
            .subscribe(function (applicationCohorts) { return _this.applicationCohorts = applicationCohorts; });
    };
    AppViewComponent.prototype.switchApplication = function (application) {
        this.router.navigate(["/detailView/", application.applicationId]);
    };
    AppViewComponent.prototype.filterApplicationByName = function (term) {
        var _this = this;
        this.applicationCohortService.getApplicationCohortsByApplicationName(term)
            .debounceTime(30000)
            .subscribe(function (applicationCohort) {
            _this.applicationCohorts = applicationCohort;
            if (_this.filteredApplications !== null) {
                console.log("I work");
                console.log(_this.applicationCohorts);
            }
        });
    };
    return AppViewComponent;
}());
__decorate([
    core_1.ViewChild("appView"),
    __metadata("design:type", Object)
], AppViewComponent.prototype, "appView", void 0);
AppViewComponent = __decorate([
    core_1.Component({
        templateUrl: "./templates/appView.php"
    }),
    __metadata("design:paramtypes", [applicationCohort_service_1.ApplicationCohortService, router_1.Router])
], AppViewComponent);
exports.AppViewComponent = AppViewComponent;
//# sourceMappingURL=appView-component.js.map