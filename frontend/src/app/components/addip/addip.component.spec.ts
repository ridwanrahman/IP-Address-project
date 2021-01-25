import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AddipComponent } from './addip.component';

describe('AddipComponent', () => {
  let component: AddipComponent;
  let fixture: ComponentFixture<AddipComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AddipComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AddipComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
