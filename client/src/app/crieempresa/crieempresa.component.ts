import { Component } from '@angular/core';
import { BackgroundComponent } from '../background/background.component';
import { HeaderComponent } from '../header/header.component';
import { DashboardComponent } from '../dashboard/dashboard.component';

@Component({
  selector: 'app-crieempresa',
  standalone: true,
  templateUrl: './crieempresa.component.html',
  styleUrl: './crieempresa.component.css',
  imports: [BackgroundComponent, HeaderComponent, DashboardComponent],
})
export class CrieempresaComponent {}
