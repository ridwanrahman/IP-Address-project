import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  public form = {
    email: null,
    password: null
  };

  public error = null;

  constructor(private http:HttpClient) { }

  onSubmit(){
    console.log("something");
    this.http.post('http://127.0.0.1:8000/api/auth/login',this.form).subscribe(
      data => console.log(data),
      error => this.handleError(error)
    );
  }

  handleError(error) {
    console.log("this is called");
    console.log(error);
    if(error['status'] != 200){
      this.error = "Email or password doesn't exist";
    }
  }

  ngOnInit(): void {
  }

}
