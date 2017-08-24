"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var Observable_1 = require("rxjs/Observable");
var status_1 = require("../classes/status");
var BaseService = (function () {
    function BaseService(http) {
        this.http = http;
    }
    BaseService.prototype.extractData = function (response) {
        if (response.status < 200 || response.status >= 300) {
            throw (new Error("Bad response status: " + response.status));
        }
        var json = response.json();
        if (json.status !== 200) {
            throw (new Error("Bad API status: " + json.status));
        }
        return (json.data);
    };
    BaseService.prototype.extractMessage = function (response) {
        if (response.status < 200 || response.status >= 300) {
            throw (new Error("Bad response status: " + response.status));
        }
        var json = response.json();
        var jsonStatus = "alert-success";
        if (json.status !== 200) {
            jsonStatus = "alert-danger";
        }
        var status = new status_1.Status(json.status, json.message, jsonStatus);
        return (status);
    };
    BaseService.prototype.handleError = function (error) {
        var message = error.message;
        console.log(message);
        return (Observable_1.Observable.throw(message));
    };
    return BaseService;
}());
exports.BaseService = BaseService;
//# sourceMappingURL=base-service.js.map