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
var prospect_service_1 = require("../services/prospect-service");
var cohort_service_1 = require("../services/cohort-service");
var prospectCohort_service_1 = require("../services/prospectCohort-service");
var PrsViewComponent = (function () {
    function PrsViewComponent(prospectService, prospectCohortService, cohortService, router, route) {
        this.prospectService = prospectService;
        this.prospectCohortService = prospectCohortService;
        this.cohortService = cohortService;
        this.router = router;
        this.route = route;
        this.prospects = [];
        this.prospectCohorts = [];
        this.cohorts = [];
        this.status = null;
    }
    PrsViewComponent.prototype.ngOnInit = function () {
        this.reloadProspects();
        this.reloadProspectCohorts();
        this.reloadCohorts();
    };
    PrsViewComponent.prototype.reloadProspects = function () {
        var _this = this;
        this.prospectService.getAllProspects()
            .subscribe(function (prospects) { return _this.prospects = prospects; });
    };
    PrsViewComponent.prototype.reloadProspectCohorts = function () {
        var _this = this;
        this.prospectCohortService.getAllProspectCohorts()
            .subscribe(function (prospectCohorts) { return _this.prospectCohorts = prospectCohorts; });
    };
    PrsViewComponent.prototype.reloadCohorts = function () {
        var _this = this;
        this.cohortService.getAllCohorts()
            .subscribe(function (cohorts) { return _this.cohorts = cohorts; });
    };
    PrsViewComponent.prototype.switchProspect = function (prospect) {
        this.router.navigate(["/prsDetailView/", prospect.prospectId]);
    };
    return PrsViewComponent;
}());
__decorate([
    core_1.ViewChild("prsView"),
    __metadata("design:type", Object)
], PrsViewComponent.prototype, "prsView", void 0);
PrsViewComponent = __decorate([
    core_1.Component({
        templateUrl: "./templates/prsView.php"
    }),
    __metadata("design:paramtypes", [prospect_service_1.ProspectService,
        prospectCohort_service_1.ProspectCohortService,
        cohort_service_1.CohortService,
        router_1.Router,
        router_1.ActivatedRoute])
], PrsViewComponent);
exports.PrsViewComponent = PrsViewComponent;
//# sourceMappingURL=prsView-component.js.map