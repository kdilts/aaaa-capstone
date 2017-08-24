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
var core_2 = require("@angular/core");
var noteType_service_1 = require("../services/noteType-service");
require("rxjs/add/operator/switchMap");
var NavbarComponent = (function () {
    function NavbarComponent(/*private applicationService: ApplicationService, */ noteTypeService) {
        this.noteTypeService = noteTypeService;
        this.open = new core_2.EventEmitter();
        this.close = new core_2.EventEmitter();
        this.noteTypes = [];
        this.searchResults = []; // search results
        this.ApplicationLastName = "";
        this.ApplicationFirstName = "";
    }
    NavbarComponent.prototype.ngOnInit = function () {
        //this.applicationService.getAllApplications();
        this.reloadNoteTypes();
    };
    NavbarComponent.prototype.reloadNoteTypes = function () {
        var _this = this;
        this.noteTypeService.getAllNoteTypes()
            .subscribe(function (noteTypes) { return _this.noteTypes = noteTypes; });
    };
    return NavbarComponent;
}());
__decorate([
    core_1.Output(),
    __metadata("design:type", core_2.EventEmitter)
], NavbarComponent.prototype, "open", void 0);
__decorate([
    core_1.Output(),
    __metadata("design:type", core_2.EventEmitter)
], NavbarComponent.prototype, "close", void 0);
NavbarComponent = __decorate([
    core_1.Component({
        selector: "navbar",
        templateUrl: "./templates/navbar.php"
    }),
    __metadata("design:paramtypes", [noteType_service_1.NoteTypeService])
], NavbarComponent);
exports.NavbarComponent = NavbarComponent;
//# sourceMappingURL=navbar-component.js.map