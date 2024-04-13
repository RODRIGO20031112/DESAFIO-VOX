import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CrieempresaComponent } from './crieempresa.component';

describe('CrieempresaComponent', () => {
  let component: CrieempresaComponent;
  let fixture: ComponentFixture<CrieempresaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CrieempresaComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(CrieempresaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
