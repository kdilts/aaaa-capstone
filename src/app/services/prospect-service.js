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
var ProspectService = (function (_super) {
    __extends(ProspectService, _super);
    function ProspectService(http) {
        var _this = _super.call(this, http) || this;
        _this.http = http;
        _this.prospectUrl = "api/prospect/";
        return _this;
    }
    ProspectService.prototype.getAllProspects = function () {
        return (this.http.get(this.prospectUrl)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ProspectService.prototype.getProspectByProspectId = function (prospectId) {
        return (this.http.get(this.prospectUrl + prospectId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ProspectService.prototype.getProspectByProspectEmail = function (prospectEmail) {
        return (this.http.get(this.prospectUrl + prospectEmail)
            .map(this.extractData)
            .catch(this.handleError));
    };
    //TODO: prospectLastName/FirstName?
    ProspectService.prototype.getProspectsByProspectName = function (prospectFirstName, prospectLastName) {
        return (this.http.get(this.prospectUrl + prospectFirstName + prospectLastName)
            .map(this.extractData)
            .catch(this.handleError));
    };
    ProspectService.prototype.createProspect = function (prospect) {
        return (this.http.post(this.prospectUrl, prospect)
            .map(this.extractMessage)
            .catch(this.handleError));
    };
    return ProspectService;
}(base_service_1.BaseService));
ProspectService = __decorate([
    core_1.Injectable(),
    __metadata("design:paramtypes", [http_1.Http])
], ProspectService);
exports.ProspectService = ProspectService;
//# sourceMappingURL=prospect-service.js.map