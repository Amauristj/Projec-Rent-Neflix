import { Component, OnInit } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, NgForm } from '@angular/forms';
import { IndexWebService } from '../services/index-web.service';
import {rentAccountUser} from '../models/rentaccountuser.interface';

IndexWebService

@Component({
  selector: 'app-index-web',
  templateUrl: './index-web.component.html',
  styleUrls: ['./index-web.component.css']
})
export class IndexWebComponent implements OnInit {
  AccountNeflix:any = [];
  AccountUserNeflix:any = [];

  RentAccountUser = new rentAccountUser('', 0, 0);

  constructor(private indexWeb:IndexWebService ) { }

  ngOnInit(): void {
    this.indexWeb.getAccountON().subscribe(accountNeflix => {this.AccountNeflix = accountNeflix.netflix_account});
  }

  RentAccountAndUser(form:NgForm){
    this.indexWeb.insertRentAccount(this.RentAccountUser).subscribe(data => console.log(data));
    
  }

  GetUserON(event:any):void{
   let id_account = event.target.value;
   this.indexWeb.getAccountUserON(id_account).subscribe(accountuserNeflix => {this.AccountUserNeflix = accountuserNeflix.netflix_user});
   console.log(id_account);

  }

}
