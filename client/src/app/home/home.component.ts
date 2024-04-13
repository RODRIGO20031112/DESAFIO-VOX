import { Component } from '@angular/core';
import { HeaderComponent } from '../header/header.component';
import { BackgroundComponent } from '../background/background.component';
import { HomeinfosComponent } from '../homeinfos/homeinfos.component';

@Component({
  selector: 'app-home',
  standalone: true,
  templateUrl: './home.component.html',
  styleUrl: './home.component.css',
  imports: [HeaderComponent, BackgroundComponent, HomeinfosComponent],
})
export class HomeComponent {}
