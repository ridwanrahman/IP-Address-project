import { Component, OnInit } from '@angular/core';
import { UserHandlerService } from 'src/app/Services/user-handler.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  public userName = "";
  public userID = "";
  public userEmail = "";

  constructor(
    private userHandler:UserHandlerService
  ) { }

  ngOnInit(): void {
    console.log("dashboard");
    this.userName = this.userHandler.getUserName();
    console.log("dashboard ends");
  }

}
