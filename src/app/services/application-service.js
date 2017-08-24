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
var ApplicationService = (function (_super) {
    __extends(ApplicationService, _super);
    function ApplicationService(http) {
        var _this = _super.call(this, http) || this;
        _this.http = http;
        _this.applicationUrl = "api/application/";
        return _this;
    }
    ApplicationService.prototype.getAllApplications = function () {
        return (this.http.get(this.applicationUrl)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ApplicationService.prototype.getApplicationsByApplicationDateRange = function (startDate, endDate) {
        return (this.http.get(this.applicationUrl + startDate + endDate)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ApplicationService.prototype.getApplicationByApplicationEmail = function (applicationEmail) {
        return (this.http.get(this.applicationUrl + applicationEmail)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ApplicationService.prototype.getApplicationByApplicationId = function (applicationId) {
        return (this.http.get(this.applicationUrl + applicationId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ApplicationService.prototype.getApplicationsByApplicationFirstName = function (applicationFirstName) {
        return (this.http.get(this.applicationUrl + applicationFirstName))
            .map(this.extractData)
            ._catch(this.handleError);
    };
    ApplicationService.prototype.getApplicationsByApplicationName = function (applicationName) {
        return (this.http.get(this.applicationUrl + "?applicationName=" + applicationName)
            .map(this.extractData)
            .catch(this.handleError));
    };
    return ApplicationService;
}(base_service_1.BaseService));
ApplicationService = __decorate([
    core_1.Injectable(),
    __metadata("design:paramtypes", [http_1.Http])
], ApplicationService);
exports.ApplicationService = ApplicationService;
//# sourceMappingURL=application-service.js.map