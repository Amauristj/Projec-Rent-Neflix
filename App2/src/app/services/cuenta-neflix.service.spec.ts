import { TestBed } from '@angular/core/testing';

import { CuentaNeflixService } from './cuenta-neflix.service';

describe('CuentaNeflixService', () => {
  let service: CuentaNeflixService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CuentaNeflixService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
