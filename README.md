# 🚀 Template HPP

Sistema Web desenvolvido com **Laravel** no backend e **Nuxt (Vue.js)** no frontend.  
O projeto utiliza **MySQL** como banco de dados.

---

## 📋 Requisitos

Antes de começar, garanta que os seguintes itens estejam instalados na sua máquina:

- [XAMPP](https://www.apachefriends.org/pt_br/index.html) (para Apache e MySQL)
- [PHP 8.0+](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Node.js 18+](https://nodejs.org/)
- [Git](https://git-scm.com/)

---

## 🧩 Estrutura do Projeto

```
/TEMPLATE-HPP
│
├── laravel-API/              # Projeto Laravel
│   ├── app/
│   ├── routes/
│   └── ...
│
└── nuxt/             # Projeto Vue/Nuxt
    ├── pages/
    ├── components/
    └── ...
```

---

## ⚙️ Instalação do Backend (Laravel)

### 1. Acesse o diretório do backend

```bash
cd laravel-API
```

### 2. Instale as dependências do Laravel

```bash
composer install
```

### 3. Crie o arquivo de ambiente

```bash
cp .env.example .env
```

### 4. Configure o banco de dados no .env

Abra o arquivo `.env` e edite as linhas abaixo conforme seu XAMPP:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=root
DB_PASSWORD=
```

💡 **Dica:** crie o banco de dados manualmente pelo phpMyAdmin (http://localhost/phpmyadmin) antes de rodar as migrations.

### 5. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 6. Execute as migrations (e seeds, se houver)

```bash
php artisan migrate --seed
```

### 7. Inicie o servidor Laravel

```bash
php artisan serve
```

Por padrão, ele estará disponível em:

```
http://127.0.0.1:8000
```

---

## 🌐 Instalação do Frontend (Nuxt)

### 1. Acesse o diretório do frontend

```bash
cd nuxt
```

### 2. Instale as dependências

```bash
npm install
```


### 3. Execute o servidor de desenvolvimento

```bash
npm run dev
```


Por padrão, o frontend estará disponível em:

```
http://localhost:3000
```

---

## 🖥️ Configurando o XAMPP

1. Inicie o **Apache** e o **MySQL** pelo painel do XAMPP.
2. Acesse o phpMyAdmin em:  
   👉 http://localhost/phpmyadmin
3. Crie um banco com o mesmo nome configurado no `.env` do Laravel.

---


## 🧪 Testando a Aplicação

Acesse:

- **Frontend (Nuxt):** http://localhost:3000

---

## 🧰 Comandos Úteis

| Descrição | Comando |
|-----------|---------|
| Rodar servidor Laravel | `php artisan serve` |
| Rodar servidor Nuxt | `npm run dev` |
| Rodar migrations | `php artisan migrate` |
| Atualizar dependências do backend | `composer update` |
| Atualizar dependências do frontend | `npm update` |

---

## 🧑‍💻 Autor

**Henrique Roas Martins Marquito**  
💼 Desenvolvedor Fullstack (Laravel + Vue/Nuxt)

---

## 📝 Licença

Este projeto está sob a licença MIT. Consulte o arquivo `LICENSE` para mais informações.

