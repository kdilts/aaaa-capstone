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
var activeDirectory_service_1 = require("../services/activeDirectory-service");
var activeDirectory_1 = require("../classes/activeDirectory");
var LoginViewComponent = (function () {
    function LoginViewComponent(activeDirectoryService) {
        this.activeDirectoryService = activeDirectoryService;
        this.loginData = new activeDirectory_1.ActiveDirectory("", "");
        this.status = null;
    }
    LoginViewComponent.prototype.login = function () {
        var _this = this;
        this.activeDirectoryService.login(this.loginData)
            .subscribe(function (status) {
            _this.status = status;
            if (status.apiStatus === 200) {
                _this.loginForm.reset();
            }
        });
    };
    return LoginViewComponent;
}());
__decorate([
    core_1.ViewChild("loginForm"),
    __metadata("design:type", Object)
], LoginViewComponent.prototype, "loginForm", void 0);
LoginViewComponent = __decorate([
    core_1.Component({
        templateUrl: "./templates/loginView.php"
    }),
    __metadata("design:paramtypes", [activeDirectory_service_1.ActiveDirectoryService])
], LoginViewComponent);
exports.LoginViewComponent = LoginViewComponent;
//# sourceMappingURL=loginView-component.js.map