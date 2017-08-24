"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var router_1 = require("@angular/router");
var home_component_1 = require("./components/home-component");
var noteType_component_1 = require("./components/noteType-component");
var detailView_component_1 = require("./components/detailView-component");
var prsDetailView_component_1 = require("./components/prsDetailView-component");
var pkgView_component_1 = require("./components/pkgView-component");
var appView_component_1 = require("./components/appView-component");
var prsView_component_1 = require("./components/prsView-component");
var mobView_component_1 = require("./components/mobView-component");
var loginView_component_1 = require("./components/loginView-component");
var navbar_component_1 = require("./components/navbar-component");
var mailView_component_1 = require("./components/mailView-component");
exports.allAppComponents = [
    home_component_1.HomeComponent,
    noteType_component_1.NoteTypeComponent,
    appView_component_1.AppViewComponent,
    pkgView_component_1.PkgViewComponent,
    prsView_component_1.PrsViewComponent,
    detailView_component_1.DetailViewComponent,
    prsDetailView_component_1.PrsDetailViewComponent,
    mobView_component_1.MobViewComponent,
    loginView_component_1.LoginViewComponent,
    navbar_component_1.NavbarComponent,
    mailView_component_1.MailViewComponent
];
exports.routes = [
    { path: "", component: home_component_1.HomeComponent },
    { path: "noteType", component: noteType_component_1.NoteTypeComponent },
    { path: "navbar", component: navbar_component_1.NavbarComponent },
    { path: "appView", component: appView_component_1.AppViewComponent },
    { path: "prsView", component: prsView_component_1.PrsViewComponent },
    { path: "pkgView", component: pkgView_component_1.PkgViewComponent },
    { path: "detailView/:applicationId", component: detailView_component_1.DetailViewComponent },
    { path: "prsDetailView/:prospectId", component: prsDetailView_component_1.PrsDetailViewComponent },
    { path: "loginView", component: loginView_component_1.LoginViewComponent },
    { path: "mobView", component: mobView_component_1.MobViewComponent },
    { path: "mailView", component: mailView_component_1.MailViewComponent }
];
exports.appRoutingProviders = [];
exports.routing = router_1.RouterModule.forRoot(exports.routes);
//# sourceMappingURL=app.routes.js.map