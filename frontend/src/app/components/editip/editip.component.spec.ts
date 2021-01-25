import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EditipComponent } from './editip.component';

describe('EditipComponent', () => {
  let component: EditipComponent;
  let fixture: ComponentFixture<EditipComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EditipComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(EditipComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
