import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {NoteTypeComponent} from "./components/noteType-component";
import {DetailViewComponent} from "./components/detailView-component";
import {PkgViewComponent} from "./components/pkgView-component";
import {AppViewComponent} from "./components/appView-component";
import {PrsViewComponent} from "./components/prsView-component";

export const allAppComponents = [
	HomeComponent,
	NoteTypeComponent,
	AppViewComponent,
	PkgViewComponent,
	PrsViewComponent,
	DetailViewComponent
];

export const routes: Routes = [
	{path: "", component: HomeComponent},
	{path: "noteType", component: NoteTypeComponent },
	{path: "appView", component: AppViewComponent },
	{path: "prsView", component: AppViewComponent },
	{path: "pkgView", component: PkgViewComponent },
	{path: "detailView/:applicationId", component: DetailViewComponent }
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);