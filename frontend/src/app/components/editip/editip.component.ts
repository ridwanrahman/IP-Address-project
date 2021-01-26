import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { TokenService } from 'src/app/Services/token.service';

@Component({
  selector: 'app-editip',
  templateUrl: './editip.component.html',
  styleUrls: ['./editip.component.css']
})
export class EditipComponent implements OnInit {

  private ipslug = "";
  public token = "";
  public form = {
    label:null,
    ip:null,
    comment:null,
    timestamp:null
  };

  constructor(
    private route:ActivatedRoute,
    private http:HttpClient,
    private tokenService:TokenService
  ) { }

  ngOnInit(): void {
    this.token = this.tokenService.get();
    this.ipslug = this.route.snapshot.paramMap.get("ipslug");
    this.getData(this.ipslug);
  }

  getData(ipslug){
    this.http.get('http://127.0.0.1:8000/api/getIPRecordByID/'+this.ipslug,{
      headers: {
        "Authorization": 'Bearer '+this.token
      }
    }).subscribe(
      data => this.handleDataResponse(data),
      error => this.handleDataError(error)
    );
  }

  handleDataResponse(data){
    // console.log(data[0][0]);
    this.form = data[0][0];
    console.log(this.form);
  }
  handleDataError(error){
    console.log(error);
  }

  onSubmit() {
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
    this.form.timestamp = dateTime;
    this.http.post('http://127.0.0.1:8000/api/editIPRecordById',this.form, {
      headers:{
        "Authorization": 'Bearer '+this.token
      }
    }).subscribe(
      data => console.log(data),
      error => console.log(error)
    );
  }
  handleSubmitResponse(data){
    console.log(data);
  }
  handleSubmitError(error){
    console.log(error);
  }

}
