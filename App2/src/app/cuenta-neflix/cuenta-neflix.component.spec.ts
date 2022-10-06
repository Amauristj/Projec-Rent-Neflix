import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CuentaNeflixComponent } from './cuenta-neflix.component';

describe('CuentaNeflixComponent', () => {
  let component: CuentaNeflixComponent;
  let fixture: ComponentFixture<CuentaNeflixComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CuentaNeflixComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CuentaNeflixComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
