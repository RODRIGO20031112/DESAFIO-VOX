import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SociosPageComponent } from './socios-page.component';

describe('SociosPageComponent', () => {
  let component: SociosPageComponent;
  let fixture: ComponentFixture<SociosPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [SociosPageComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(SociosPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
