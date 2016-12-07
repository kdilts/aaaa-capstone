import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {NoteTypeComponent} from "./components/noteType-component";

export const allAppComponents = [HomeComponent, NoteTypeComponent];

export const routes: Routes = [
	{path: "", component: HomeComponent},
	{path: "noteType", component: NoteTypeComponent }
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);