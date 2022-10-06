import { TestBed } from '@angular/core/testing';

import { UserNetflixServicesService } from './user-netflix-services.service';

describe('UserNetflixServicesService', () => {
  let service: UserNetflixServicesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(UserNetflixServicesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
