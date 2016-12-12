import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {NoteTypeComponent} from "./components/noteType-component";
import {DetailViewComponent} from "./components/detailView-component";
import {PkgViewComponent} from "./components/pkgView-component";
import {AppViewComponent} from "./components/appView-component";
import {PrsViewComponent} from "./components/prsView-component";
import {MobViewComponent} from "./components/mobView-component";
import {LoginViewComponent} from "./components/loginView-component";

export const allAppComponents = [
	HomeComponent,
	NoteTypeComponent,
	AppViewComponent,
	PkgViewComponent,
	PrsViewComponent,
	DetailViewComponent,
	MobViewComponent,
	LoginViewComponent
];

export const routes: Routes = [
	{path: "", component: HomeComponent},
	{path: "noteType", component: NoteTypeComponent },
	{path: "appView", component: AppViewComponent },
	{path: "prsView", component: PrsViewComponent },
	{path: "pkgView", component: PkgViewComponent },
	{path: "detailView/:applicationId", component: DetailViewComponent },
	{path: "loginView", component: LoginViewComponent},
	{path: "mobView", component: MobViewComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);