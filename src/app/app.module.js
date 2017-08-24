"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
var core_1 = require("@angular/core");
var platform_browser_1 = require("@angular/platform-browser");
var forms_1 = require("@angular/forms");
var http_1 = require("@angular/http");
var app_component_1 = require("./app.component");
var app_routes_1 = require("./app.routes");
var noteType_service_1 = require("./services/noteType-service");
var application_service_1 = require("./services/application-service");
var prospect_service_1 = require("./services/prospect-service");
var studentPermit_service_1 = require("./services/studentPermit-service");
var cohort_service_1 = require("./services/cohort-service");
var applicationCohort_service_1 = require("./services/applicationCohort-service");
var note_service_1 = require("./services/note-service");
var prospectCohort_service_1 = require("./services/prospectCohort-service");
var activeDirectory_service_1 = require("./services/activeDirectory-service");
var moduleDeclarations = [app_component_1.AppComponent];
var AppModule = (function () {
    function AppModule() {
    }
    return AppModule;
}());
AppModule = __decorate([
    core_1.NgModule({
        imports: [platform_browser_1.BrowserModule, forms_1.FormsModule, http_1.HttpModule, app_routes_1.routing],
        declarations: moduleDeclarations.concat(app_routes_1.allAppComponents),
        bootstrap: [app_component_1.AppComponent],
        providers: [
            app_routes_1.appRoutingProviders,
            noteType_service_1.NoteTypeService,
            application_service_1.ApplicationService,
            prospect_service_1.ProspectService,
            note_service_1.NoteService,
            studentPermit_service_1.StudentPermitService,
            applicationCohort_service_1.ApplicationCohortService,
            prospectCohort_service_1.ProspectCohortService,
            cohort_service_1.CohortService,
            activeDirectory_service_1.ActiveDirectoryService
        ]
    })
], AppModule);
exports.AppModule = AppModule;
//a change 
//# sourceMappingURL=app.module.js.map