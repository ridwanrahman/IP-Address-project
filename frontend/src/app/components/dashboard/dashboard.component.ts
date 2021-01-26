import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { TokenService } from 'src/app/Services/token.service';
import { UserHandlerService } from 'src/app/Services/user-handler.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  public userName = "";
  public userID;
  public userEmail = "";
  public token = "";
  public ipData = [];
  public auditData = [];

  constructor(
    private http:HttpClient,
    private userHandler:UserHandlerService,
    private tokenService:TokenService
  ) { }

  ngOnInit(): void {
    // console.log("dashboard");
    this.userName = this.userHandler.getUserName();
    this.userID = this.userHandler.getUserId();
    this.userEmail = this.userHandler.getUserEmail();
    this.token = this.tokenService.get();
    // console.log("dashboard ends");
    this.getIPData();
    this.getAuditData();
  }

  getAuditData() {
    this.http.get('http://127.0.0.1:8000/api/getUserAudits',{
      headers: {
        "Authorization": 'Bearer '+this.token
      }
    }).subscribe(
      data => this.handleAuditResponse(data),
      error => console.log(error)
    );
  }

  handleAuditResponse(data) {
    // console.log(data);
    this.auditData = data[0];
  }
  handleAuditError(error) {

  }

  getIPData(){
    this.http.get('http://127.0.0.1:8000/api/getAllIP/'+this.userID,{
      headers: {
        "Authorization": 'Bearer '+this.token
      }
    }).subscribe(
      data => this.handleResponse(data),
      error => this.handleError(error)
    );
  }

  handleResponse(data){
    // console.log(data);
    this.ipData = data[0];
  }

  handleError(data) {

  }
}
