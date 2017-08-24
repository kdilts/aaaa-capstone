"use strict";
var __extends = (this && this.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
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
var http_1 = require("@angular/http");
var base_service_1 = require("./base-service");
var ProspectCohortService = (function (_super) {
    __extends(ProspectCohortService, _super);
    function ProspectCohortService(http) {
        var _this = _super.call(this, http) || this;
        _this.http = http;
        _this.prospectCohortUrl = "api/prospectCohort/";
        return _this;
    }
    ProspectCohortService.prototype.getAllProspectCohorts = function () {
        return (this.http.get(this.prospectCohortUrl)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ProspectCohortService.prototype.getProspectCohortsByProspectId = function (prospectCohortProspectId) {
        return (this.http.get(this.prospectCohortUrl + prospectCohortProspectId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ProspectCohortService.prototype.getProspectCohortsByCohortId = function (prospectCohortCohortId) {
        return (this.http.get(this.prospectCohortUrl + prospectCohortCohortId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ProspectCohortService.prototype.getProspectCohort = function (prospectCohortId) {
        return (this.http.get(this.prospectCohortUrl + prospectCohortId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ProspectCohortService.prototype.createProspectCohort = function (prospectCohort) {
        return (this.http.post(this.prospectCohortUrl, prospectCohort)
            .map(this.extractMessage)
            .catch(this.handleError));
    };
    return ProspectCohortService;
}(base_service_1.BaseService));
ProspectCohortService = __decorate([
    core_1.Injectable(),
    __metadata("design:paramtypes", [http_1.Http])
], ProspectCohortService);
exports.ProspectCohortService = ProspectCohortService;
//# sourceMappingURL=prospectCohort-service.js.map