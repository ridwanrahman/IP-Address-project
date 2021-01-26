import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { TokenService } from 'src/app/Services/token.service';
import { UserHandlerService } from 'src/app/Services/user-handler.service';

import {NgbModal, NgbModalConfig} from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-addip',
  templateUrl: './addip.component.html',
  styleUrls: ['./addip.component.css'],
  providers: [NgbModalConfig, NgbModal]
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
    private modalService: NgbModal,
    config: NgbModalConfig
  ) {
    config.backdrop = 'static';
    config.keyboard = false;
   }

  // open(content) {
  //   this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
  //     this.closeResult = `Closed with: ${result}`;
  //   }, (reason) => {
  //     this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
  //   });
  // }

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
  open(content) {
    this.modalService.open(content);
  }
  handleResponse(data){
    console.log(data);
    // var content="asdfasfasfasf";
    // this.open(content);
    
  }
  handleError(error){
    console.log(error.error.errors);
    this.error.ip = error.error.errors.ip[0];
  }

  ngOnInit(): void {
    this.token = this.tokenService.get();
  }

}
