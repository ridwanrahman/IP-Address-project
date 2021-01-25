import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { AfterLoginService } from './Services/after-login.service';
import { BeforeLoginService } from './Services/before-login.service';

const routes: Routes = [
  {
    path:'login',
    component:LoginComponent,
    canActivate:[BeforeLoginService]
  },
  {
    path:'dashboard',
    component:DashboardComponent,
    canActivate:[AfterLoginService]
  },
  {
    path:'register',
    component:RegisterComponent,
    canActivate:[BeforeLoginService]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
