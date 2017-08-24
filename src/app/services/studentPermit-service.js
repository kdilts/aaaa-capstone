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
var StudentPermitService = (function (_super) {
    __extends(StudentPermitService, _super);
    function StudentPermitService(http) {
        var _this = _super.call(this, http) || this;
        _this.http = http;
        _this.studentPermitUrl = "api/studentPermit/";
        return _this;
    }
    StudentPermitService.prototype.getAllStudentPermits = function () {
        return (this.http.get(this.studentPermitUrl)
            .map(this.extractData)
            .catch(this.handleError));
    };
    // TODO verify date range functions
    StudentPermitService.prototype.getStudentPermitsByCheckInDateRange = function (startDate, endDate) {
        return (this.http.get(this.studentPermitUrl + startDate + endDate)
            .map(this.extractData)
            .catch(this.handleError));
    };
    StudentPermitService.prototype.getStudentPermitsByCheckOutDateRange = function (startDate, endDate) {
        return (this.http.get(this.studentPermitUrl + startDate + endDate)
            .map(this.extractData)
            .catch(this.handleError));
    };
    StudentPermitService.prototype.getStudentPermitByPlacardId = function (studentPermitPlacardId) {
        return (this.http.get(this.studentPermitUrl + studentPermitPlacardId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    StudentPermitService.prototype.getStudentPermitBySwipeId = function (studentPermitSwipeId) {
        return (this.http.get(this.studentPermitUrl + studentPermitSwipeId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    StudentPermitService.prototype.getStudentPermitByApplicationId = function (studentPermitApplicationId) {
        return (this.http.get(this.studentPermitUrl + studentPermitApplicationId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    StudentPermitService.prototype.getStudentPermit = function (studentPermitId) {
        return (this.http.get(this.studentPermitUrl + studentPermitId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    StudentPermitService.prototype.createStudentPermit = function (studentPermit) {
        return (this.http.post(this.studentPermitUrl, studentPermit)
            .map(this.extractMessage)
            .catch(this.handleError));
    };
    return StudentPermitService;
}(base_service_1.BaseService));
StudentPermitService = __decorate([
    core_1.Injectable(),
    __metadata("design:paramtypes", [http_1.Http])
], StudentPermitService);
exports.StudentPermitService = StudentPermitService;
//# sourceMappingURL=studentPermit-service.js.map