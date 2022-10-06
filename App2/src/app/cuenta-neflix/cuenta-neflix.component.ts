import { Component, OnInit } from '@angular/core';
import { CuentaNeflixService } from '../services/cuenta-neflix.service';

import {  CuentaNeflix } from "../models/cuenta.interface";

import { FormGroup, FormControl, Validators, NgForm } from '@angular/forms';
import { Subscription } from 'rxjs';



@Component({
  selector: 'app-cuenta-neflix',
  templateUrl: './cuenta-neflix.component.html',
  styleUrls: ['./cuenta-neflix.component.css']
})
export class CuentaNeflixComponent implements OnInit {
  
  cuentasNeflix:any = [];
  cuentanetflixOne:any;
  editar: any = false;
  subscription: Subscription = new Subscription;
  
  
  
  constructor(private cuentaNeflix: CuentaNeflixService) {

   }

   DatosnewCuenta = new CuentaNeflix(0,'','');
  
  ngOnInit(): void {
    this.getAccountNetflix();
    this.cuentaNeflix.refresh.subscribe(() => {this.getAccountNetflix();})
    
  }

  getAccountNetflix(){
    this.cuentaNeflix.getAllAcountNetflix().subscribe(cuentasNeflix =>{
      this.cuentasNeflix = cuentasNeflix.users;
      //console.log(this.cuentasNeflix);
    });
  }
  registrarCuentaNetflix(form:NgForm){
    this.cuentaNeflix.insertar_cuenta_netflix(this.DatosnewCuenta).subscribe(data => console.log(data));
    form.reset()
    
  }

  eliminarcuenta(id:Number){
    this.cuentaNeflix.delete_account(id).subscribe((cuentasNeflix) =>{this.getAccountNetflix})
    console.log(this.cuentasNeflix)
  }

  update(id:Number, form:NgForm){
    this.cuentaNeflix.update_cuenta(id, this.DatosnewCuenta).subscribe(data => console.log(data))
    this.editar = false
    form.reset();
  }

  editar_cuenta(id:Number){
    this.cuentaNeflix.editar_cuenta(id).subscribe(cuentasNeflix =>{
      this.DatosnewCuenta = cuentasNeflix.massage;
      this.editar = true;
     
    });
    
  }
}
