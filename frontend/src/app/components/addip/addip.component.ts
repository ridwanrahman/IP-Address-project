import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { SnotifyService } from 'ng-snotify';
import { TokenService } from 'src/app/Services/token.service';
import { UserHandlerService } from 'src/app/Services/user-handler.service';

@Component({
  selector: 'app-addip',
  templateUrl: './addip.component.html',
  styleUrls: ['./addip.component.css'],
})
export class AddipComponent implements OnInit {

  closeResult = '';
  public response = "";
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
    private tokenService:TokenService,
    private notify:SnotifyService,
    private router:Router
  ) { 
    // notify.error('hello');
  }

  onSubmit() {
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
    this.form.timestamp = dateTime;
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
    let _router = this.router;
    this.form = {
      label: null,
      ip: null,
      comment:null,
      user_id:null,
      timestamp:null
    };
    this.error = {
      ip:null
    };
    this.notify.confirm('Done! Your IP Address has been added', {
      buttons:[
        {
          text:'Okay', 
          action:toaster => {_router.navigateByUrl('/dashboard'),this.notify.remove(toaster.id)}
        },
      ]
    });
  }

  handleError(error){
    console.log(error.error.errors);
    this.error.ip = error.error.errors.ip[0];
  }

  ngOnInit(): void {
    this.token = this.tokenService.get();
  }

}
