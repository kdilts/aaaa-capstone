import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {NoteTypeComponent} from "./components/noteType-component";
import {DetailViewComponent} from "./components/detailView-component";
import {PkgViewComponent} from "./components/pkgView-component";
import {AppViewComponent} from "./components/appView-component";
import {PrsViewComponent} from "./components/prsView-component";
import {LoginViewComponent} from "./components/loginView-component";

export const allAppComponents = [
	HomeComponent,
	NoteTypeComponent,
	AppViewComponent,
	PkgViewComponent,
	PrsViewComponent,
	DetailViewComponent,
	LoginViewComponent
];

export const routes: Routes = [
	{path: "", component: HomeComponent},
	{path: "noteType", component: NoteTypeComponent },
	{path: "appView", component: AppViewComponent },
	{path: "prsView", component: PrsViewComponent },
	{path: "pkgView", component: PkgViewComponent },
	{path: "detailView/:applicationId", component: DetailViewComponent },
	{path: "loginView", component: LoginViewComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);