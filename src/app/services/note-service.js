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
var NoteService = (function (_super) {
    __extends(NoteService, _super);
    function NoteService(http) {
        var _this = _super.call(this, http) || this;
        _this.http = http;
        _this.noteUrl = "api/note/";
        return _this;
    }
    NoteService.prototype.getAllNotes = function () {
        return (this.http.get(this.noteUrl)
            .map(this.extractData)
            .catch(this.handleError));
    };
    NoteService.prototype.getNoteByNoteId = function (noteId) {
        return (this.http.get(this.noteUrl + noteId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    NoteService.prototype.getNotesByNoteApplicationId = function (noteApplicationId) {
        return (this.http.get(this.noteUrl + "?noteApplicationId=" + noteApplicationId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    NoteService.prototype.getNotesByNoteProspectId = function (noteProspectId) {
        return (this.http.get(this.noteUrl + "?noteProspectId=" + noteProspectId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    NoteService.prototype.getNotesByNoteNoteTypeId = function (noteNoteTypeId) {
        return (this.http.get(this.noteUrl + noteNoteTypeId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    NoteService.prototype.getNotesByBridgeStaffId = function (noteBridgeStaffId) {
        return (this.http.get(this.noteUrl + noteBridgeStaffId)
            .map(this.extractData)
            .catch(this.handleError));
    };
    NoteService.prototype.getNotesByNoteDateRange = function (startDate, endDate) {
        return (this.http.get(this.noteUrl + startDate + endDate)
            .map(this.extractData)
            .catch(this.handleError));
    };
    NoteService.prototype.createNote = function (note) {
        return (this.http.post(this.noteUrl, note)
            .map(this.extractMessage)
            .catch(this.handleError));
    };
    return NoteService;
}(base_service_1.BaseService));
NoteService = __decorate([
    core_1.Injectable(),
    __metadata("design:paramtypes", [http_1.Http])
], NoteService);
exports.NoteService = NoteService;
//# sourceMappingURL=note-service.js.map