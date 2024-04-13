import { Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { CrieempresaComponent } from './crieempresa/crieempresa.component';
import { SociosPageComponent } from './socios-page/socios-page.component';

export const routes: Routes = [
  {
    path: '',
    component: HomeComponent,
  },
  {
    path: 'crie-sua-empresa',
    component: CrieempresaComponent,
  },
  {
    path: 'socios-empresa',
    component: SociosPageComponent,
  },
];
