import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, tap, Subject } from 'rxjs';
import { userNeflix } from '../models/usernetflix.interface';
import { JsonPipe } from '@angular/common';
import { rentAccountUser } from '../models/rentaccountuser.interface';

@Injectable({
  providedIn: 'root'
})
export class IndexWebService {

  constructor(private http: HttpClient) { }

  public getAccountON():Observable<any>{
    return this.http.get('http://127.0.0.1:8000/account/netflix/obtenerON');
  }

  public getAccountUserON(id_account:number):Observable<any>{
    return this.http.get('http://127.0.0.1:8000/user/netflix/obtener/'+id_account);
  }

  public insertRentAccount(rentAccountUser:rentAccountUser) {
    let json = JSON.stringify(rentAccountUser);
    console.log(json);
    return this.http.post('http://127.0.0.1:8000/rent/users', {json:json});
  }
}
