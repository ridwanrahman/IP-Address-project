import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { TokenService } from 'src/app/Services/token.service';
import { UserHandlerService } from 'src/app/Services/user-handler.service';

@Component({
  selector: 'app-addip',
  templateUrl: './addip.component.html',
  styleUrls: ['./addip.component.css']
})
export class AddipComponent implements OnInit {

  public form = {
    label: null,
    ip: null,
    comment:null,
    user_id:null,
    timestamp:null
  };
  public error = {
    ip:null
  };
  public token = "";

  constructor(
    private http:HttpClient,
    private userhandler:UserHandlerService,
    private tokenService:TokenService
  ) { }

  onSubmit() {
    console.log("herere");
    console.log(this.form);
    this.form.user_id = this.userhandler.getUserId();
    this.http.post('http://127.0.0.1:8000/api/addip',this.form,{
      headers: {
        "Authorization": 'Bearer '+this.token
      }
    }).subscribe(
      data => this.handleResponse(data),
      error => this.handleError(error)
    );
  }
  handleResponse(data){
    console.log(data);
  }
  handleError(error){
    console.log(error.error.errors);
    this.error.ip = error.error.errors.ip[0];
  }

  ngOnInit(): void {
    this.token = this.tokenService.get();
  }

}
