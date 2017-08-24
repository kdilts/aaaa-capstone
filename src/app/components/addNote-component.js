"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
var core_1 = require("@angular/core");
var SimpleFormComp = (function () {
    function SimpleFormComp() {
    }
    SimpleFormComp.prototype.onSubmit = function (f) {
        console.log(f.value); // { first: '', last: '' }
        console.log(f.valid); // false
    };
    return SimpleFormComp;
}());
SimpleFormComp = __decorate([
    core_1.Component({
        selector: 'example-app',
        template: "\n    <form #f=\"ngForm\" (ngSubmit)=\"onSubmit(f)\" novalidate>\n      <input name=\"first\" ngModel required #first=\"ngModel\">\n      <input name=\"last\" ngModel>\n      <button>Submit</button>\n    </form>\n    <p>First name value: {{ first.value }}</p>\n    <p>First name valid: {{ first.valid }}</p>\n    <p>Form value: {{ f.value | json }}</p>\n    <p>Form valid: {{ f.valid }}</p>\n  ",
    })
], SimpleFormComp);
exports.SimpleFormComp = SimpleFormComp;
//# sourceMappingURL=addNote-component.js.map