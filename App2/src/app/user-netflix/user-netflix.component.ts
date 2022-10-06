import { Component, LOCALE_ID, OnInit } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, NgForm } from '@angular/forms';
import { CuentaNeflix } from '../models/cuenta.interface';
import { userNeflix } from '../models/usernetflix.interface';
import { UserNetflixServicesService } from '../services/user-netflix-services.service';

@Component({
  selector: 'app-user-netflix',
  templateUrl: './user-netflix.component.html',
  styleUrls: ['./user-netflix.component.css']
})
export class UserNetflixComponent implements OnInit {

  usersNeflix:any = [];
  editar: any = false;
  formUser: any = false;
  idcuentaNetflixUser: number = 0;
  
  constructor( private UserNeflix: UserNetflixServicesService) { 
   
  }
  Usersneflix = new userNeflix(0,'',0);

  
 

  ngOnInit(): void {
    
    this.getUserbyAccount();
    this.UserNeflix.refresh.subscribe(() => {this.getUserbyAccount();})
    
  }

  getUserbyAccount(){
    this.UserNeflix.getUserByAccout().subscribe(usersNeflix => {this.usersNeflix = usersNeflix.netflix_user});
    
  }

  guardarUsuarioNetflix(form:NgForm, id_cuneta_netflix:number){
    let id_user:number = 4;
    let id_CuentaNeflix:number = id_cuneta_netflix;
    this.UserNeflix.insertarUser(id_user, id_CuentaNeflix,this.Usersneflix).subscribe(data => console.log(data));
    this.formUser = false;
  }


  deleteUser(id_user: number){
    this.UserNeflix.delete_user(id_user).subscribe(data => console.log(data))
  }

  updateUSer(id:number, form:NgForm){
    this.UserNeflix.Update(id, this.Usersneflix).subscribe(data => console.log(data))
    this.editar = false
    this.formUser = false;
  }

  editar_user(id:Number){
    this.UserNeflix.editar_usuario(id).subscribe(usersNeflix =>{
      this.Usersneflix = usersNeflix.massage;
      this.formUser = true;
      this.editar = true;
      console.log(this.usersNeflix.massage)
    });
    
  }

  formUserNetflix(id:number){
    this.formUser = true;
    this.idcuentaNetflixUser = id
    console.log(id);
  }

}




