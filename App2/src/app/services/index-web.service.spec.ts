import { TestBed } from '@angular/core/testing';

import { IndexWebService } from './index-web.service';

describe('IndexWebService', () => {
  let service: IndexWebService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(IndexWebService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
