# Encurtador de Links

### Configure o projeto em sua máquina
Após clonar o projeto do github dentro dele terá duas pastas
- frontend
- backend

primeiramente, configure o back-end. Essa configuração deve ser feita 
dentro da pasta "backend" 

1. Configurar o .env

```bash
  cp .env.example .env
```

2. Instale as dependencias com o composer

```bash
  composer install
```

3. Gere a key de acesso do Laravel

```bash
  php artisan key:generate
```

4. Configuração de variavéis de ambiente de acesso ao
banco de dados MYSQL. Faça isso no arquivo .env

```bash
DB_HOST=host
DB_PORT=porta
DB_DATABASE=nome_banco
DB_USERNAME=usuario_banco
DB_PASSWORD=senha_banco
```

5. Criação das tabelas no banco de dados

```bash
  php artisan migrate
```

6. Execução do projeto com o servidor do proprio laravel

```bash
  php artisan serve
```

Agora, configure o front-end. Para isso, você deve estar dentro
da pasta "frontend" e fazer duas configurações:

1. Verifique se a variavél de ambiente **VITE_BASE_URL_API**
encontrada no arquivo .env está apontando corretamente 
para o servidor php.

```bash
VITE_BASE_URL_API=http://127.0.0.1:8000/api/
```

2. Instale as dependências do projeto e o execute

```bash
yarn install

yarn dev
```

Essas configurações tendem a ser adequadas para a execução do projeto e para a realização de testes em suas funcionalidades. 
No entanto, caso se depare com qualquer eventualidade, não hesite em entrar em contato comigo.


### Contatos

[![Linkedin](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/heningtonfrota/) 
[![Instagram](https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white)](https://www.instagram.com/heningtonfrota/)

<br />
<br />