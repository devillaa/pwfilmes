# 🎬 ToVerde Films

Um sistema completo de gerenciamento de filmes desenvolvido com Laravel.

## 📋 Índice

-   [Visão Geral](#visão-geral)
-   [Funcionalidades](#funcionalidades)
-   [Tecnologias Utilizadas](#tecnologias-utilizadas)
-   [Instalação](#instalação)
-   [Estrutura do Projeto](#estrutura-do-projeto)
-   [Arquivos CSS e JavaScript](#arquivos-css-e-javascript)
-   [Uso](#uso)
-   [Contribuição](#contribuição)

## 🎯 Visão Geral

O ToVerde Films é um sistema completo de gerenciamento de filmes que permite:

-   **Catálogo de Filmes**: Visualização e busca de filmes
-   **Sistema de Favoritos**: Usuários podem favoritar filmes
-   **Dashboard Administrativo**: Gerenciamento completo do sistema
-   **Interface Moderna**: Design responsivo e intuitivo

## ✨ Funcionalidades

### Para Usuários

-   📺 Visualizar catálogo de filmes
-   🔍 Filtrar por ano e categoria
-   ❤️ Favoritar filmes
-   🎬 Assistir trailers
-   📱 Interface responsiva

### Para Administradores

-   📊 Dashboard de estatísticas
-   ✏️ Gerenciamento de filmes
-   📂 Gerenciamento de categorias
-   📈 Relatórios e métricas

## 🛠️ Tecnologias Utilizadas

-   **Backend**: Laravel 11 (PHP 8.2+)
-   **Frontend**: HTML5, CSS3, JavaScript (ES6+)
-   **Banco de Dados**: MySQL/PostgreSQL
-   **Design**: CSS Custom Properties, Flexbox, Grid
-   **Animações**: CSS Transitions, Intersection Observer

## 🚀 Instalação

### Pré-requisitos

-   PHP 8.2 ou superior
-   Composer
-   MySQL/PostgreSQL
-   Node.js (opcional, para assets)

### Passos de Instalação

1. **Clone o repositório**

```bash
git clone https://github.com/seu-usuario/pwfilmes.git
cd pwfilmes
```

2. **Instale as dependências PHP**

```bash
composer install
```

3. **Configure o ambiente**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados**

```bash
# Edite o arquivo .env com suas configurações de banco
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pwfilmes
DB_USERNAME=root
DB_PASSWORD=
```

5. **Execute as migrações**

```bash
php artisan migrate
```

6. **Execute os seeders**

```bash
php artisan db:seed
```

7. **Configure o storage**

```bash
php artisan storage:link
```

8. **Inicie o servidor**

```bash
php artisan serve
```

O sistema estará disponível em `http://localhost:8000`

## 📁 Estrutura do Projeto

```
pwfilmes/
├── app/
│   ├── Console/Commands/     # Comandos Artisan
│   ├── Http/Controllers/     # Controladores
│   ├── Models/              # Modelos Eloquent
│   └── Services/            # Serviços
├── database/
│   ├── migrations/          # Migrações
│   └── seeders/            # Seeders
├── public/
│   ├── css/                # Arquivos CSS
│   └── js/                 # Arquivos JavaScript
├── resources/
│   └── views/              # Views Blade
└── routes/
    └── web.php             # Rotas web
```

## 🎨 Arquivos CSS e JavaScript

### CSS

-   **`main.css`**: Estilos base, variáveis CSS, componentes gerais
-   **`filmes.css`**: Estilos específicos para a seção de filmes
-   **`dashboard.css`**: Estilos do dashboard administrativo
-   **`categorias.css`**: Estilos para gerenciamento de categorias
-   **`auth.css`**: Estilos para autenticação (login/registro)

### JavaScript

-   **`main.js`**: Funcionalidades gerais, utilitários, gerenciadores
-   **`dashboard.js`**: Funcionalidades específicas do dashboard
-   **`filmes.js`**: Funcionalidades da página de filmes

### Características do Design

#### Sistema de Design

-   **Variáveis CSS**: Cores, espaçamentos, tipografia centralizados
-   **Componentes Reutilizáveis**: Botões, cards, formulários padronizados
-   **Responsividade**: Mobile-first design
-   **Animações**: Transições suaves e micro-interações
-   **Acessibilidade**: Contraste adequado, navegação por teclado

#### Paleta de Cores

```css
:root {
    --primary-color: #6366f1; /* Azul principal */
    --secondary-color: #10b981; /* Verde */
    --accent-color: #f59e0b; /* Laranja */
    --bg-primary: #0f172a; /* Fundo escuro */
    --bg-secondary: #1e293b; /* Fundo secundário */
    --text-primary: #f8fafc; /* Texto principal */
    --text-secondary: #cbd5e1; /* Texto secundário */
}
```

## 📖 Uso

### Acessando o Sistema

1. **Acesse** `http://localhost:8000`
2. **Registre-se** ou **faça login**
3. **Navegue** pelo catálogo de filmes
4. **Favorite** seus filmes preferidos

### Funcionalidades Administrativas

1. **Faça login** como administrador
2. **Acesse o Dashboard** para ver estatísticas
3. **Gerencie filmes** através do painel administrativo
4. **Organize categorias** conforme necessário

## 🤝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 🔗 Links Úteis

-   [Laravel Documentation](https://laravel.com/docs)
-   [Inter Font (Google Fonts)](https://fonts.google.com/specimen/Inter)

---

**Desenvolvido com ❤️ usando Laravel**
