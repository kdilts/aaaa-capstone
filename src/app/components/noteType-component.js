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
var noteType_service_1 = require("../services/noteType-service");
var noteType_1 = require("../classes/noteType");
var NoteTypeComponent = (function () {
    function NoteTypeComponent(noteTypeService, router) {
        this.noteTypeService = noteTypeService;
        this.router = router;
        this.noteTypes = [];
        this.noteType = new noteType_1.NoteType(null, "");
        this.status = null;
    }
    NoteTypeComponent.prototype.ngOnInit = function () {
        this.reloadNoteTypes();
    };
    NoteTypeComponent.prototype.reloadNoteTypes = function () {
        var _this = this;
        this.noteTypeService.getAllNoteTypes()
            .subscribe(function (noteTypes) { return _this.noteTypes = noteTypes; });
    };
    NoteTypeComponent.prototype.createNoteType = function () {
        var _this = this;
        this.noteTypeService.createNoteType(this.noteType)
            .subscribe(function (status) {
            _this.status = status;
            if (status.apiStatus === 200) {
                _this.reloadNoteTypes();
                _this.noteTypeForm.reset();
            }
        });
    };
    return NoteTypeComponent;
}());
__decorate([
    core_1.ViewChild("noteTypeForm"),
    __metadata("design:type", Object)
], NoteTypeComponent.prototype, "noteTypeForm", void 0);
NoteTypeComponent = __decorate([
    core_1.Component({
        templateUrl: "./templates/noteType.php"
    }),
    __metadata("design:paramtypes", [noteType_service_1.NoteTypeService,
        router_1.Router])
], NoteTypeComponent);
exports.NoteTypeComponent = NoteTypeComponent;
//# sourceMappingURL=noteType-component.js.map