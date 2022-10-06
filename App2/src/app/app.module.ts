import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { Router, RouterModule } from '@angular/router';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { CuentaNeflixComponent } from './cuenta-neflix/cuenta-neflix.component';

import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatFormFieldModule} from '@angular/material/form-field';
import { FormsModule } from '@angular/forms';

import { ReactiveFormsModule } from '@angular/forms';
import { UserNetflixComponent } from './user-netflix/user-netflix.component';
import { IndexWebComponent } from './index-web/index-web.component';
import { MatSelectModule } from '@angular/material/select';


@NgModule({
  declarations: [
    AppComponent,
    CuentaNeflixComponent,
    UserNetflixComponent,
    IndexWebComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    AppRoutingModule,
    MatFormFieldModule,
    ReactiveFormsModule,
    MatSelectModule,
    FormsModule,
    RouterModule.forRoot([
      {path: 'cuentasNeflix', component: CuentaNeflixComponent},
      {path: 'userNeflix', component: UserNetflixComponent},
      {path: 'index', component: IndexWebComponent}
    ]),
    BrowserAnimationsModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
