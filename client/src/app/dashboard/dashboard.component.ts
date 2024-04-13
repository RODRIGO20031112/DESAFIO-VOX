import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css',
})
export class DashboardComponent implements OnInit {
  public user = '';

  private url_I = 'http://127.0.0.1:8000/cadastrar-empresas';

  constructor(private httpClient: HttpClient, private router: Router) {}

  public isLoading: boolean = false;

  async onSubmit() {
    this.isLoading = true;
    try {
      const response = await this.httpClient
        .post(this.url_I, {
          nome_empresa: this.user,
        })
        .toPromise();
      console.log('Resposta da requisição:', response);
      this.getEmpresas();
      this.isLoading = false;
    } catch (error) {
      console.error('Erro na requisição:', error);
      this.isLoading = false;
    }
  }

  // ******************************************************

  private url_II = 'http://127.0.0.1:8000/listar-empresas';

  public empresas = [
    {
      empresa_id: 'SEU-ID',
      nome_empresa: 'Sua empresa Inc',
      data_criacao: '0000-00-00 Últimas atualizações',
    },
  ];

  async getEmpresas() {
    try {
      const response: any = await this.httpClient.get(this.url_II).toPromise();
      console.log('Resposta da requisição:', response);
      this.empresas = response;
    } catch (error) {
      console.error('Erro na requisição:', error);
    }
  }

  ngOnInit() {
    this.getEmpresas();
  }

  // ******************************************************

  public isReadOnly = true;
  public editableEmpresaId: string = '';

  toggleReadOnly(id: string) {
    this.isReadOnly = true;
    this.editableEmpresaId = id;
  }

  async onSubmitEdit(mesmoId: string, novaEmpresa: string) {
    const url_III = `http://127.0.0.1:8000/atualizar-empresa/${mesmoId}`;

    this.isLoading = true;
    try {
      const response = await this.httpClient
        .put(url_III, {
          nome_empresa: novaEmpresa,
        })
        .toPromise();
      console.log('Resposta da requisição:', response);
      this.getEmpresas();
      this.isLoading = false;
    } catch (error) {
      console.error('Erro na requisição:', error);
      this.isLoading = false;
    }
  }

  //*****************************************************************

  async onSubmitDelete(mesmoId: string) {
    const url_IV = `http://127.0.0.1:8000/deletar-empresa/${mesmoId}`;

    this.isLoading = true;
    try {
      const response = await this.httpClient.delete(url_IV).toPromise();
      console.log('Resposta da requisição:', response);
      this.getEmpresas();
      this.isLoading = false;
    } catch (error) {
      console.error('Erro na requisição:', error);
      this.isLoading = false;
    }
  }

  navegarParaSociosEmpresa(id: string) {
    this.router.navigate(['/socios-empresa'], { queryParams: { id: id } });
  }
}
