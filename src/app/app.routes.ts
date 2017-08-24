import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {NoteTypeComponent} from "./components/noteType-component";
import {DetailViewComponent} from "./components/detailView-component";
import {PrsDetailViewComponent} from "./components/prsDetailView-component";
import {PkgViewComponent} from "./components/pkgView-component";
import {AppViewComponent} from "./components/appView-component";
import {PrsViewComponent} from "./components/prsView-component";
import {MobViewComponent} from "./components/mobView-component";
import {LoginViewComponent} from "./components/loginView-component";
import {NavbarComponent} from "./components/navbar-component";
import {MailViewComponent} from "./components/mailView-component";

export const allAppComponents = [
	HomeComponent,
	NoteTypeComponent,
	AppViewComponent,
	PkgViewComponent,
	PrsViewComponent,
	DetailViewComponent,
	PrsDetailViewComponent,
	MobViewComponent,
	LoginViewComponent,
	NavbarComponent,
	MailViewComponent

];

export const routes: Routes = [
	{path: "", component: HomeComponent},
	{path: "noteType", component: NoteTypeComponent },
	{path: "navbar", component: NavbarComponent },
	{path: "appView", component: AppViewComponent },
	{path: "prsView", component: PrsViewComponent },
	{path: "pkgView", component: PkgViewComponent },
	{path: "detailView/:applicationId", component: DetailViewComponent },
	{path: "prsDetailView/:prospectId", component: PrsDetailViewComponent },
	{path: "loginView", component: LoginViewComponent},
	{path: "mobView", component: MobViewComponent},
	{path: "mailView", component: MailViewComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);