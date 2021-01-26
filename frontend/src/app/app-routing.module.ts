import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AddipComponent } from './components/addip/addip.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { EditipComponent } from './components/editip/editip.component';
import { HomepageComponent } from './components/homepage/homepage.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { AfterLoginService } from './Services/after-login.service';
import { BeforeLoginService } from './Services/before-login.service';

const routes: Routes = [
  {
    path:'',
    component:HomepageComponent,
    canActivate:[BeforeLoginService]
  },
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
  },
  {
    path:'add-ip',
    component:AddipComponent,
    canActivate:[AfterLoginService]
  },
  {
    path:'editip/:ipslug',
    component:EditipComponent,
    canActivate:[AfterLoginService]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
