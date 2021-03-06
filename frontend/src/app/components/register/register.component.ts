import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { SnotifyService } from 'ng-snotify';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  public form = {
    name: null,
    email: null,
    password: null,
    password_confirmation: null
  };
  public error = {
    name: null,
    email: null,
    password: null,
    password_confirmation: null
  };

  constructor(
    private http:HttpClient,
    private router: Router,
    private notify:SnotifyService
    ) {
      // notify.error('hello');
    }

  onSubmit() {
    console.log("something");
    this.http.post('http://127.0.0.1:8000/api/auth/register',this.form).subscribe(
      data => this.handleResponse(data),
      error => this.handleError(error)
    );
  }

  handleResponse(data){
    // this.router.navigateByUrl('/login');
    let _router = this.router;
    this.form = {
      name: null,
      email: null,
      password: null,
      password_confirmation: null
    };
    this.error = {
      name: null,
      email: null,
      password: null,
      password_confirmation: null
    };
    this.notify.confirm('Done! You are registered. Login to continue', {
      buttons:[
        {
          text:'Okay', 
          action:toaster => {_router.navigateByUrl('/login'),this.notify.remove(toaster.id)}
        },
      ]
    });
  }

  handleError(error) {
    console.log(error.error[0]);
    if("name" in error.error[0]){
      this.error.name = error.error[0].name[0];
    }
    if("email" in error.error[0]){
      this.error.email = error.error[0].email[0];
    }
    if("password" in error.error[0]) {
      for(var i=0;i<error.error[0].password.length;i++) {
        console.log(error.error[0].password[i]);
        this.error.password = error.error[0].password[i];
      }
    }
  }

  ngOnInit(): void {
  }

}
