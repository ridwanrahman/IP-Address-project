import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

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

  constructor(private http:HttpClient) { }

  onSubmit() {
    console.log("something");
    this.http.post('http://127.0.0.1:8000/api/auth/register',this.form).subscribe(
      data => console.log(data),
      error => this.handleError(error)
    );
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
