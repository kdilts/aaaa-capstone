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
var prospect_service_1 = require("../services/prospect-service");
var prospectCohort_service_1 = require("../services/prospectCohort-service");
var note_1 = require("../classes/note");
var note_service_1 = require("../services/note-service");
var prospect_1 = require("../classes/prospect");
var noteType_service_1 = require("../services/noteType-service");
require("rxjs/add/operator/switchMap");
var PrsDetailViewComponent = (function () {
    function PrsDetailViewComponent(prospectService, prospectCohortService, noteService, noteTypeService, router, activatedRoute) {
        this.prospectService = prospectService;
        this.prospectCohortService = prospectCohortService;
        this.noteService = noteService;
        this.noteTypeService = noteTypeService;
        this.router = router;
        this.activatedRoute = activatedRoute;
        this.prospect = new prospect_1.Prospect(null, "", "", "", "");
        this.prospectCohorts = [];
        this.notes = [];
        this.note = new note_1.Note(null, null, null, null, "", "");
        this.status = null;
        this.noteTypes = [];
        this.noteNoteType = null;
    }
    PrsDetailViewComponent.prototype.ngOnInit = function () {
        this.reloadProspect();
        this.reloadNoteTypes();
    };
    PrsDetailViewComponent.prototype.reloadProspect = function () {
        var _this = this;
        this.activatedRoute.params
            .switchMap(function (params) { return _this.prospectService.getProspectByProspectId(+params["prospectId"]); })
            .subscribe(function (prospect) {
            //this.prospect = prospect[0];
            _this.prospect = prospect;
            console.log(_this.prospect);
            _this.note.noteProspectId = _this.prospect.prospectId;
            _this.noteService.getNotesByNoteProspectId(_this.prospect.prospectId)
                .subscribe(function (notes) { return _this.notes = notes.reverse(); });
            _this.prospectCohortService.getProspectCohortsByProspectId(_this.prospect.prospectId)
                .subscribe(function (prospectCohorts) { return _this.prospectCohorts = prospectCohorts; });
        });
    };
    PrsDetailViewComponent.prototype.reloadNoteTypes = function () {
        var _this = this;
        this.noteTypeService.getAllNoteTypes()
            .subscribe(function (noteTypes) { return _this.noteTypes = noteTypes; });
    };
    PrsDetailViewComponent.prototype.createNote = function () {
        var _this = this;
        this.noteService.createNote(this.note)
            .subscribe(function (status) {
            _this.status = status;
            if (status.apiStatus === 200) {
                _this.reloadProspect();
                _this.prsDetailView.reset();
            }
        });
    };
    return PrsDetailViewComponent;
}());
__decorate([
    core_1.ViewChild("prsDetailView"),
    __metadata("design:type", Object)
], PrsDetailViewComponent.prototype, "prsDetailView", void 0);
PrsDetailViewComponent = __decorate([
    core_1.Component({
        templateUrl: "./templates/prsDetailView.php"
    }),
    __metadata("design:paramtypes", [prospect_service_1.ProspectService,
        prospectCohort_service_1.ProspectCohortService,
        note_service_1.NoteService,
        noteType_service_1.NoteTypeService,
        router_1.Router,
        router_1.ActivatedRoute])
], PrsDetailViewComponent);
exports.PrsDetailViewComponent = PrsDetailViewComponent;
// export class SimpleFormComp {
// 	onSubmit(f: NgForm) {
// 		console.log(f.value);  // { first: '', last: '' }
// 		console.log(f.valid);  // false
// 	}
// } 
//# sourceMappingURL=prsDetailView-component.js.map