import { Component } from '@angular/core';
import { SociosComponent } from '../socios/socios.component';
import { BackgroundComponent } from '../background/background.component';
import { HeaderComponent } from '../header/header.component';

@Component({
  selector: 'app-socios-page',
  standalone: true,
  templateUrl: './socios-page.component.html',
  styleUrl: './socios-page.component.css',
  imports: [SociosComponent, BackgroundComponent, HeaderComponent],
})
export class SociosPageComponent {}
