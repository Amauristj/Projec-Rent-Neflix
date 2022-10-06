import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UserNetflixComponent } from './user-netflix.component';

describe('UserNetflixComponent', () => {
  let component: UserNetflixComponent;
  let fixture: ComponentFixture<UserNetflixComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ UserNetflixComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(UserNetflixComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
