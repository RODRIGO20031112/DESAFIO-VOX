import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-socios',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './socios.component.html',
  styleUrl: './socios.component.css',
})
export class SociosComponent implements OnInit {
  id!: string;

  public isLoading = false;

  constructor(private route: ActivatedRoute, private httpClient: HttpClient) {}

  ngOnInit(): void {
    this.route.queryParams.subscribe((params) => {
      this.id = params['id'];
      this.getSocios(this.id);
    });
  }

  public dataSocios = [
    {
      socio_id: '',
      id_empresa: '',
      nome_socio: '',
      data_criacao: null,
    },
  ];

  async getSocios(id: string) {
    const url = `http://127.0.0.1:8000/listar-socios/${id}`;
    this.isLoading = true;
    try {
      const response: any = await this.httpClient.get(url).toPromise();
      console.log('Resposta da requisição:', response);
      this.dataSocios = response;
      this.isLoading = false;
    } catch (error) {
      console.error('Erro na requisição:', error);
      this.isLoading = false;
    }
  }

  public nomeSocio = '';

  async cadastrarSocios(id: string) {
    const url = `http://127.0.0.1:8000/cadastrar-socios`;
    this.isLoading = true;
    try {
      const response = await this.httpClient
        .post(url, {
          nome_socio: this.nomeSocio,
          id_empresa: id,
        })
        .toPromise();
      console.log('Resposta da requisição:', response);
      this.getSocios(id);
      this.isLoading = false;
    } catch (error) {
      console.error('Erro na requisição:', error);
      this.isLoading = false;
    }
  }

  public isReadOnly = true;
  public editableEmpresaId: string = '';

  toggleReadOnly(id: string | null) {
    this.isReadOnly = true;
    if (id !== null) {
      this.editableEmpresaId = id;
    }
  }

  async updateSocio(socioId: string, novoSocio: string, idEmpresa: string) {
    const url = `http://127.0.0.1:8000/atualizar-socio/${socioId}`;

    this.isLoading = true;
    try {
      const response = await this.httpClient
        .put(url, {
          nome_socio: novoSocio,
        })
        .toPromise();
      console.log('Resposta da requisição:', response);
      this.getSocios(idEmpresa);

      this.isLoading = false;
    } catch (error) {
      console.error('Erro na requisição:', error);
      this.isLoading = false;
    }
  }
  async deleteSocio(socioId: string, idEmpresa: string) {
    const url = `http://127.0.0.1:8000/deletar-socio/${socioId}`;

    this.isLoading = true;
    try {
      const response = await this.httpClient.delete(url).toPromise();
      console.log('Resposta da requisição:', response);
      this.getSocios(idEmpresa);
      this.isLoading = false;
    } catch (error) {
      console.error('Erro na requisição:', error);
      this.isLoading = false;
    }
  }
}
