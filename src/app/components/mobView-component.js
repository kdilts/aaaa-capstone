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
var prospect_1 = require("../classes/prospect");
var cohort_service_1 = require("../services/cohort-service");
var MobViewComponent = (function () {
    function MobViewComponent(cohortService, prospectService, router) {
        this.cohortService = cohortService;
        this.prospectService = prospectService;
        this.router = router;
        this.prospect = new prospect_1.Prospect(0, "", "", "", "");
        this.status = null;
        this.cohorts = [];
    }
    MobViewComponent.prototype.ngOnInit = function () {
        this.reloadCohorts();
    };
    MobViewComponent.prototype.reloadCohorts = function () {
        var _this = this;
        this.cohortService.getAllCohorts()
            .subscribe(function (cohorts) { return _this.cohorts = cohorts; });
    };
    MobViewComponent.prototype.createProspect = function () {
        var _this = this;
        this.prospectService.createProspect(this.prospect)
            .subscribe(function (status) {
            _this.status = status;
            if (status.apiStatus === 200) {
                _this.quickProspectForm.reset();
            }
        });
    };
    return MobViewComponent;
}());
__decorate([
    core_1.ViewChild("quickProspectForm"),
    __metadata("design:type", Object)
], MobViewComponent.prototype, "quickProspectForm", void 0);
MobViewComponent = __decorate([
    core_1.Component({
        templateUrl: "./templates/mobView.php"
    }),
    __metadata("design:paramtypes", [cohort_service_1.CohortService,
        prospect_service_1.ProspectService,
        router_1.Router])
], MobViewComponent);
exports.MobViewComponent = MobViewComponent;
//# sourceMappingURL=mobView-component.js.map