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
var application_service_1 = require("../services/application-service");
var applicationCohort_service_1 = require("../services/applicationCohort-service");
var note_1 = require("../classes/note");
var note_service_1 = require("../services/note-service");
var application_1 = require("../classes/application");
var noteType_service_1 = require("../services/noteType-service");
require("rxjs/add/operator/switchMap");
var DetailViewComponent = (function () {
    function DetailViewComponent(applicationService, applicationCohortService, noteService, noteTypeService, router, activatedRoute) {
        this.applicationService = applicationService;
        this.applicationCohortService = applicationCohortService;
        this.noteService = noteService;
        this.noteTypeService = noteTypeService;
        this.router = router;
        this.activatedRoute = activatedRoute;
        this.application = new application_1.Application(null, "", "", "", "", "", "", "", "", "", "", "", "");
        this.applicationCohorts = [];
        this.notes = [];
        this.note = new note_1.Note(null, null, null, null, "", "");
        this.status = null;
        this.noteTypes = [];
        this.testDate = null;
    }
    DetailViewComponent.prototype.ngOnInit = function () {
        this.reloadApplication();
        this.reloadNoteTypes();
    };
    DetailViewComponent.prototype.reloadApplication = function () {
        var _this = this;
        this.activatedRoute.params
            .switchMap(function (params) { return _this.applicationService.getApplicationByApplicationId(+params["applicationId"]); })
            .subscribe(function (application) {
            _this.application = application;
            console.log(_this.application);
            _this.testDate = application.applicationDateTime;
            _this.note.noteApplicationId = _this.application.applicationId;
            _this.noteService.getNotesByNoteApplicationId(_this.application.applicationId)
                .subscribe(function (notes) { return _this.notes = notes.reverse(); });
            _this.applicationCohortService.getApplicationCohortsByApplicationId(_this.application.applicationId)
                .subscribe(function (applicationCohorts) { return _this.applicationCohorts = applicationCohorts; });
        });
    };
    DetailViewComponent.prototype.reloadNoteTypes = function () {
        var _this = this;
        this.noteTypeService.getAllNoteTypes()
            .subscribe(function (noteTypes) { return _this.noteTypes = noteTypes; });
    };
    DetailViewComponent.prototype.createNote = function () {
        var _this = this;
        this.noteService.createNote(this.note)
            .subscribe(function (status) {
            _this.status = status;
            if (status.apiStatus === 200) {
                _this.reloadApplication();
                _this.detailView.reset();
            }
        });
    };
    return DetailViewComponent;
}());
__decorate([
    core_1.ViewChild("detailView"),
    __metadata("design:type", Object)
], DetailViewComponent.prototype, "detailView", void 0);
DetailViewComponent = __decorate([
    core_1.Component({
        templateUrl: "./templates/detailView.php"
    }),
    __metadata("design:paramtypes", [application_service_1.ApplicationService,
        applicationCohort_service_1.ApplicationCohortService,
        note_service_1.NoteService,
        noteType_service_1.NoteTypeService,
        router_1.Router,
        router_1.ActivatedRoute])
], DetailViewComponent);
exports.DetailViewComponent = DetailViewComponent;
// export class SimpleFormComp {
// 	onSubmit(f: NgForm) {
// 		console.log(f.value);  // { first: '', last: '' }
// 		console.log(f.valid);  // false
// 	}
// } 
//# sourceMappingURL=detailView-component.js.map