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
var prospect_1 = require("../classes/prospect");
var noteType_service_1 = require("../services/noteType-service");
var cohort_service_1 = require("../services/cohort-service");
require("rxjs/add/operator/switchMap");
var prospect_service_1 = require("../services/prospect-service");
var prospectCohort_service_1 = require("../services/prospectCohort-service");
var MailViewComponent = (function () {
    function MailViewComponent(applicationService, applicationCohortService, noteService, noteTypeService, prospectService, prospectCohortService, cohortService, router, activatedRoute) {
        this.applicationService = applicationService;
        this.applicationCohortService = applicationCohortService;
        this.noteService = noteService;
        this.noteTypeService = noteTypeService;
        this.prospectService = prospectService;
        this.prospectCohortService = prospectCohortService;
        this.cohortService = cohortService;
        this.router = router;
        this.activatedRoute = activatedRoute;
        this.application = new application_1.Application(null, "", "", "", "", "", "", "", "", "", "", "", "");
        this.applicationCohorts = [];
        this.prospect = new prospect_1.Prospect(null, "", "", "", "");
        this.prospectCohorts = [];
        this.notes = [];
        this.note = new note_1.Note(null, null, null, null, "", "");
        this.cohorts = [];
        this.status = null;
        this.noteTypes = [];
        this.testDate = null;
    }
    MailViewComponent.prototype.ngOnInit = function () {
        this.reloadNoteTypes();
        this.reloadCohorts();
    };
    MailViewComponent.prototype.reloadNoteTypes = function () {
        var _this = this;
        this.noteTypeService.getAllNoteTypes()
            .subscribe(function (noteTypes) { return _this.noteTypes = noteTypes; });
    };
    MailViewComponent.prototype.reloadCohorts = function () {
        var _this = this;
        this.cohortService.getAllCohorts()
            .subscribe(function (cohorts) { return _this.cohorts = cohorts; });
    };
    return MailViewComponent;
}());
__decorate([
    core_1.ViewChild("mailView"),
    __metadata("design:type", Object)
], MailViewComponent.prototype, "mailView", void 0);
MailViewComponent = __decorate([
    core_1.Component({
        templateUrl: "./templates/mailView.php"
    }),
    __metadata("design:paramtypes", [application_service_1.ApplicationService,
        applicationCohort_service_1.ApplicationCohortService,
        note_service_1.NoteService,
        noteType_service_1.NoteTypeService,
        prospect_service_1.ProspectService,
        prospectCohort_service_1.ProspectCohortService,
        cohort_service_1.CohortService,
        router_1.Router,
        router_1.ActivatedRoute])
], MailViewComponent);
exports.MailViewComponent = MailViewComponent;
// export class SimpleFormComp {
// 	onSubmit(f: NgForm) {
// 		console.log(f.value);  // { first: '', last: '' }
// 		console.log(f.valid);  // false
// 	}
// } 
//# sourceMappingURL=mailView-component.js.map