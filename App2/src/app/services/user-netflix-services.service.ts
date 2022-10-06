import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, tap, Subject } from 'rxjs';
import { userNeflix } from '../models/usernetflix.interface';
import { JsonPipe } from '@angular/common';

@Injectable({
  providedIn: 'root'
})
export class UserNetflixServicesService {
  private _refresh = new Subject<void>();
  constructor(private http: HttpClient) { }

  get refresh(){
    return this._refresh;
  }

  public getUserByAccout():Observable<any>{
    return this.http.get('http://127.0.0.1:8000/account/user/neflix');
  }

  public insertarUser(id_user:number, id_cuentaNeflix: number, user_netflix:userNeflix):Observable<any>{
    let Json = JSON.stringify(user_netflix)
    console.log(id_cuentaNeflix);
    return this.http.post('http://127.0.0.1:8000/user/netflix/'+id_user+'/'+id_cuentaNeflix,{json: Json})
    .pipe(
      tap(() => {
        this._refresh.next();
        }) 
      );
  }

   public Update(id:number, user_netflix:userNeflix):Observable<any> {
    let json = JSON.stringify(user_netflix);
    console.log(json);
    return this.http.put('http://127.0.0.1:8000/user/netflix/update/'+id, {json: json})
    .pipe(
      tap(() => {
        this._refresh.next();
        }) 
      );
  } 

  public delete_user(idUser:number):Observable<any>{
    return this.http.delete('http://127.0.0.1:8000/user/netflix/delete/'+idUser)
    .pipe(
      tap(() => {
        this._refresh.next();
        }) 
      );
  }

  public editar_usuario(id:Number): Observable<any>{
    return this.http.get('http://127.0.0.1:8000/user/edit/'+id)
    .pipe(
      tap(() => {
        this._refresh.next();
        }) 
      );
  }
}


