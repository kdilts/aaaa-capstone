"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
var core_1 = require("@angular/core");
var AppComponent = (function () {
    function AppComponent() {
        this.navCollapse = true;
    }
    AppComponent.prototype.toggleCollapse = function () {
        this.navCollapse = !this.navCollapse;
    };
    return AppComponent;
}());
AppComponent = __decorate([
    core_1.Component({
        // Update selector with YOUR_APP_NAME-app. This needs to match the custom tag in webpack/index.php
        selector: 'aaaacapstone',
        // templateUrl path to your public_html/templates directory.
        templateUrl: './templates/aaaa-capstone-app.php'
    })
], AppComponent);
exports.AppComponent = AppComponent;
//# sourceMappingURL=app.component.js.map