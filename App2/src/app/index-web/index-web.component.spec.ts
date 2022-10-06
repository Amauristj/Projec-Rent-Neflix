import { ComponentFixture, TestBed } from '@angular/core/testing';

import { IndexWebComponent } from './index-web.component';

describe('IndexWebComponent', () => {
  let component: IndexWebComponent;
  let fixture: ComponentFixture<IndexWebComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ IndexWebComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(IndexWebComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
