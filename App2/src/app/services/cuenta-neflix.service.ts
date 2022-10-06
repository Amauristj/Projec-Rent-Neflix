
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, Subject } from 'rxjs';
import {CuentaNeflix} from '../models/cuenta.interface'
import { tap } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CuentaNeflixService {

 private _refresh = new Subject<void>();

  constructor(private http:HttpClient) { }

  get refresh(){
    return this._refresh;
  }
 
  public getAllAcountNetflix(): Observable<any>{
   return this.http.get("http://127.0.0.1:8000/account");
  }

  public insertar_cuenta_netflix(json:CuentaNeflix):Observable<any>{
    let jsonn = JSON.stringify(json)
  return this.http.post('http://127.0.0.1:8000/account', { json: jsonn })
  .pipe(
    tap(() => {
      this._refresh.next();
      }) 
    );
  }

  public delete_account(id:Number):Observable<any>{
    return this.http.delete('http://127.0.0.1:8000/account/delete/'+id)
    .pipe(
      tap(() => {
        this._refresh.next();
        }) 
      );
  }

  public editar_cuenta(id:Number): Observable<any>{
    return this.http.get('http://127.0.0.1:8000/account/edit/'+id)
  }

  public update_cuenta(id:Number, json:CuentaNeflix): Observable<any>{
    let jsonn = JSON.stringify(json)
    return this.http.put('http://127.0.0.1:8000/account/update/'+id, { json: jsonn})
    .pipe(
      tap(() => {
        this._refresh.next();
        }) 
      );
  }
}
