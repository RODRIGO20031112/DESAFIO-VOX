import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HomeinfosComponent } from './homeinfos.component';

describe('HomeinfosComponent', () => {
  let component: HomeinfosComponent;
  let fixture: ComponentFixture<HomeinfosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [HomeinfosComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(HomeinfosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
