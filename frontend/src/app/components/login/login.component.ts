import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/Services/auth.service';
import { TokenService } from 'src/app/Services/token.service';
import { UserHandlerService } from 'src/app/Services/user-handler.service';

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

  constructor(
    private http:HttpClient,
    private Token:TokenService,
    private router: Router,
    private Auth:AuthService,
    private userHandler:UserHandlerService) { }

  onSubmit(){
    console.log("something");
    this.http.post('http://127.0.0.1:8000/api/auth/login',this.form).subscribe(
      data => this.handleResponse(data),
      error => this.handleError(error)
    );
  }

  handleResponse(data){
    this.userHandler.handle(data);
    this.Token.handle(data.token);
    this.Auth.changeAuthStatus(true);
    this.router.navigateByUrl('/dashboard');
  }

  handleError(error) {
    if(error['status'] != 200){
      this.error = "Email or password doesn't exist";
    }
  }

  ngOnInit(): void {
  }

}
