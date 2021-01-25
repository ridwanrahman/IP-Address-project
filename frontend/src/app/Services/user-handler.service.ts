import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class UserHandlerService {

  constructor() { }

  handle(data) {
    localStorage.setItem('id',data.id);
    localStorage.setItem('name',data.name);
    localStorage.setItem('email',data.email);
  }

  getUserId() {
    return localStorage.getItem('id');
  }
  getUserEmail() {
    return localStorage.getItem('email');
  }
  getUserName() {
    return localStorage.getItem('name');
  }
}
