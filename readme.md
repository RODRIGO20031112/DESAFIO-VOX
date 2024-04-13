# VOX-DESAFIO

## Antes de baixar o projeto certifique-se de ter o node, php, composer, synfony e PostgreSQL instalados

1. **Node:** https://nodejs.org/en/download
2. **Php:** https://www.php.net/downloads.php
3. **Composer:** https://getcomposer.org/download/
4. **Synfony:** https://symfony.com/download
5. **PostgreSQL:** https://www.postgresql.org/download/

## Instale o repositório em sua máquina

```bash
git clone https://github.com/RODRIGO20031112/DESAFIO-VOX.git
```

## Iniciando Backend em Synfony

No terminal:

```bash
cd server
```

```bash
composer install
```

```bash
symfony server:start
```

## Baixe o banco de dados

No terminal:

```bash
cd database
```

1. Copie o conteúdo de database.sql
2. Inicie o PostgreSQL
3. Abra uma tela QuerySQL para inserir o código SQL copiado
4. Depois de copiado execute o código
5. Lembre-se que a senha, usuário são as mesmas de quando você configurou o PostgreSQL

## As senhas não serão as mesmas portanto

1. Na pasta server vá até .env
2. Modifique DATABASE_URL

```bash
postgresql://SEU_USUARIO:SUA_SENHA@127.0.0.1:5432/vox-desafio?serverVersion=16&charset=utf8
```

No terminal:

## Iniciando Frontend em Angular

```bash
cd client
```

```bash
npm install
```

```bash
npm start
```

# Tutorial do site

## Para cadastrar sua empresa basta acessa http://localhost:4200 (Certifique de que o server esteja rodando na porta 8000 juntamente com o banco de dados)

<div>
<img src="1.png"/>
</div>

## Insira um nome e clique em enviar para registar sua empresa

<div>
<img src="2.png"/>
</div>

## Tabela de funcionamento de cada ícone:

1. **Lixo:** Deleta a empresa e todos os seus funcionários
2. **Lápis:** Permite alterar o nome da empresa
3. **Disquete:** Salva as alterações feitas

   **Ps I:** Quando você clica na canetao nome da empresa ficará sublinhado e você poderá editá-lo

   **Ps I:** Para ver os funcionários cadastrados, clique no ID (número) da empresa em vermelho no canto superior esquerdo da cada card empresa

<div style="display: flex; width: 50%">
<img src="3.png" style="width: 100%"/>
<img src="4.png" style="width: 100%"/>
</div>

# Para cadastrar um novo sócio a empresa escolhida basta colocar o nome e clicar em enviar

## Os ícones nessa tela tem o mesmo funcionamento da tela anterior

<div>
<img src="5.png"/>
</div>
