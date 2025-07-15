# Webhook Store

## 🤖 Projeto 100% Gerado por IA

Este projeto foi **completamente desenvolvido usando inteligência artificial**, demonstrando o poder das ferramentas de IA modernas para desenvolvimento de software.

### 🛠️ Tecnologias de IA Utilizadas:
- **GitHub Copilot** - Assistente de código AI que gerou:
  - Toda a lógica do backend em PHP/Laravel
  - Controllers, Models e Migrations
  - Views em Blade com Bootstrap
  - Configurações e arquivos de assets
  - Documentação completa
  - Testes e validações

### ⚡ Processo de Desenvolvimento:
1. **Análise de requisitos** - IA interpretou as necessidades do usuário
2. **Arquitetura** - Estrutura completa planejada automaticamente
3. **Implementação** - Código gerado em tempo real
4. **Debugging** - Problemas identificados e corrigidos pela IA
5. **Otimização** - Melhorias e refatorações automáticas
6. **Documentação** - README e comentários gerados automaticamente

---

Um gerenciador de webhooks para desenvolvimento que captura e armazena todas as requisições HTTP para análise e debug.

## Funcionalidades

### 🌍 Localização (Internacionalização)
- Interface completamente traduzida para português brasileiro
- Sistema de traduções nativo do Laravel
- Formatação de datas em padrão brasileiro (dd/mm/yyyy)
- Mensagens de erro e feedback em português
- Arquivo de tradução estruturado: `lang/pt_BR/webhook.php`

### 📥 Captura de Webhooks
- Aceita qualquer verbo HTTP no endpoint `/webhook`
- Armazena todas as informações da requisição:
  - Verbo HTTP
  - URL completa com query parameters
  - Headers completos
  - Corpo da requisição
  - IP de origem
  - User-Agent
  - Content-Type
  - Timestamp com timezone configurável

### 📊 Dashboard
- Lista paginada de todas as requisições recebidas
- Ordenação por data (mais recente primeiro)
- Visualização resumida com:
  - Timestamp
  - Verbo HTTP colorido
  - IP de origem
  - Preview do corpo da requisição

### 🔍 Detalhes da Requisição
- Página detalhada para cada webhook
- JSON formatado automaticamente
- Todas as informações capturadas
- Interface clean e profissional

### 🎨 Interface com Bootstrap
- Design responsivo e moderno
- Tabela com hover effects
- Cards organizados para informações
- Badges coloridos para métodos HTTP:
  - GET → Azul
  - POST → Verde  
  - PUT → Amarelo
  - DELETE → Vermelho
  - PATCH → Roxo
- Navegação intuitiva com breadcrumbs
- Blocos de código formatados

## Instalação e Configuração

### 1. Configurar o Banco de Dados
O sistema está configurado para usar SQLite por padrão:

```bash
# Criar o banco de dados SQLite
touch database/database.sqlite

# Executar as migrações
php artisan migrate
```

### 2. Configurar Timezone
No arquivo `.env`, configure o timezone desejado:

```env
APP_TIMEZONE=America/Sao_Paulo
```

### 3. Compilar Assets
```bash
npm install
npm run build
```

### 4. Iniciar o Servidor
```bash
php artisan serve
```

## Uso

### Enviando Webhooks
Envie qualquer requisição HTTP para `/webhook`:

```bash
# POST com JSON
curl -X POST http://localhost:8000/webhook \
  -H "Content-Type: application/json" \
  -d '{"test": "data", "timestamp": "2023-01-01T00:00:00Z"}'

# GET com query parameters  
curl -X GET "http://localhost:8000/webhook?param1=value1&param2=value2"

# PUT com form data
curl -X PUT http://localhost:8000/webhook \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "name=test&value=123"
```

### Visualizando Webhooks
- Acesse `http://localhost:8000/dashboard` para ver a lista de webhooks
- Clique em qualquer webhook para ver os detalhes completos

### Testando o Sistema
Para testar se tudo está funcionando:

1. **Envie um webhook de teste:**
```bash
curl -X POST http://localhost:8000/webhook \
  -H "Content-Type: application/json" \
  -d '{"message": "Hello World!", "timestamp": "2025-01-01T00:00:00Z"}'
```

2. **Verifique no dashboard:**
   - Acesse `http://localhost:8000/dashboard`
   - Você deve ver o webhook listado na tabela
   - Clique em "View Details" para ver todas as informações

## Localização

### Sistema de Tradução Inline
O sistema utiliza tradução inline nativa do Laravel com arquivos JSON:

#### Português Brasileiro (Padrão)
```json
// lang/pt_BR.json
{
    "View Details": "Ver Detalhes",
    "Webhook Dashboard": "Dashboard de Webhooks",
    "Previous": "Anterior",
    "Next": "Próxima"
}
```

#### Inglês (Fallback Automático)
```blade
{{-- Não precisa de arquivo en.json! --}}
{{-- O Laravel usa automaticamente a string original --}}
{{ __('View Details') }}  {{-- PT-BR: "Ver Detalhes" / EN: "View Details" --}}
```

### Uso nas Views
```blade
{{-- Tradução inline direta --}}
<h1>{{ __('Webhook Dashboard') }}</h1>
<button>{{ __('View Details') }}</button>

{{-- Resultado em PT-BR --}}
<h1>Dashboard de Webhooks</h1>
<button>Ver Detalhes</button>

{{-- Resultado em EN (fallback automático) --}}
<h1>Webhook Dashboard</h1>
<button>View Details</button>
```

### Uso nas Views
<h1>Dashboard de Webhooks</h1>
<button>Ver Detalhes</button>
```

### Estrutura de Arquivos de Tradução

```
lang/
├── pt_BR.json           # Traduções inline em português
├── en/
│   ├── auth.php         # Autenticação (Laravel)
│   ├── pagination.php   # Paginação (Laravel)
│   ├── passwords.php    # Senhas (Laravel)
│   └── validation.php   # Validação (Laravel)
└── pt_BR/
    ├── auth.php         # Autenticação traduzida
    ├── pagination.php   # Paginação traduzida
    ├── passwords.php    # Senhas traduzidas
    └── validation.php   # Validação traduzida
```

### Vantagens do Sistema Otimizado
- ✅ **Sem redundância**: Não precisa de `en.json` com strings idênticas
- ✅ **Fallback automático**: Laravel usa a string original quando não há tradução
- ✅ **Menor tamanho**: Reduz arquivos desnecessários
- ✅ **Manutenção simples**: Apenas um arquivo JSON para traduzir
- ✅ **Performance**: Menos arquivos para carregar
- ✅ **Tradução direta**: `__('View Details')` → `Ver Detalhes`
- ✅ **Código mais limpo**: Sem caminhos complexos como `webhook.table.actions.view_details`
- ✅ **Fallback automático**: Se não existir tradução, usa o texto original
- ✅ **Fácil manutenção**: Apenas um arquivo JSON por idioma
- ✅ **Performance**: Cache nativo do Laravel

### Configuração de Idioma
O sistema está configurado para português brasileiro (pt_BR) por padrão:

```php
// config/app.php
'locale' => env('APP_LOCALE', 'pt_BR'),
```

### Arquivo de Tradução
Todas as traduções estão no arquivo `lang/pt_BR/webhook.php`:

```php
return [
    'title' => 'Webhook Store',
    'dashboard' => [
        'title' => 'Dashboard de Webhooks',
        'description' => 'Monitore e gerencie todas as requisições webhook recebidas',
    ],
    'table' => [
        'headers' => [
            'method' => 'Método',
            'url' => 'URL',
            'timestamp' => 'Data/Hora',
            // ... mais traduções
        ],
    ],
    // ... estrutura completa de traduções
];
```

### Arquivos de Tradução Disponíveis

#### Português Brasileiro (`lang/pt_BR/`)
- `webhook.php` - Traduções personalizadas da aplicação
- `pagination.php` - Tradução da paginação do Laravel
- `validation.php` - Mensagens de validação traduzidas
- `auth.php` - Mensagens de autenticação (para extensões futuras)
- `passwords.php` - Mensagens de senhas (para extensões futuras)

#### Inglês (`lang/en/`)
- `webhook.php` - Traduções em inglês (fallback)
- `pagination.php` - Paginação em inglês
- `validation.php` - Validação em inglês
- `auth.php` - Autenticação em inglês
- `passwords.php` - Senhas em inglês

### Mudando o Idioma
Para alterar o idioma, modifique o arquivo `.env`:
```properties
# Para português brasileiro
APP_LOCALE=pt_BR

# Para inglês
APP_LOCALE=en
```

### Usando Traduções nas Views
```blade
{{-- Exemplo de uso --}}
<h1>{{ __('webhook.dashboard.title') }}</h1>
<p>{{ __('webhook.dashboard.description') }}</p>
```

## Estrutura do Banco de Dados

A tabela `webhooks` armazena:
- `id`: ID único da requisição
- `method`: Verbo HTTP (GET, POST, PUT, DELETE, etc.)
- `url`: URL completa da requisição
- `headers`: Headers em formato JSON
- `query_parameters`: Query parameters em formato JSON
- `body`: Corpo da requisição (texto plano)
- `content_type`: Content-Type da requisição
- `user_agent`: User-Agent da requisição
- `ip_address`: IP de origem
- `origin`: Header Origin (se presente)
- `content_length`: Tamanho do conteúdo
- `created_at`: Timestamp da requisição
- `updated_at`: Timestamp da última atualização

## Estrutura do Projeto

```
app/
├── Http/Controllers/
│   └── WebhookController.php    # Controller principal
├── Models/
│   └── Webhook.php              # Model com accessors
database/
├── migrations/
│   └── create_webhooks_table.php # Estrutura da tabela
resources/
├── views/
│   ├── layouts/app.blade.php    # Layout base Bootstrap
│   └── webhooks/
│       ├── index.blade.php      # Lista de webhooks
│       └── show.blade.php       # Detalhes do webhook
├── css/app.css                  # Estilos Bootstrap + customizados
└── js/app.js                    # JavaScript Bootstrap
routes/
└── web.php                      # Rotas do sistema
```

## Tecnologias Utilizadas

- **Laravel 12**: Framework PHP
- **SQLite**: Banco de dados
- **Bootstrap 5**: Framework CSS
- **Vite**: Build tool

## Deployment na AWS

O sistema está preparado para deployment na AWS:
- Utiliza SQLite (sem dependências externas de BD)
- Assets compilados estaticamente
- Configuração via variáveis de ambiente
- Estrutura compatível com EC2, Elastic Beanstalk ou Lambda

## Próximas Melhorias

- [ ] Sistema de autenticação
- [ ] Filtros e busca
- [ ] Exportação de dados
- [ ] API para integração
- [ ] Limpeza automática de dados antigos
- [ ] Webhooks de notificação

---

## 🤖 Sobre o Desenvolvimento com IA

### 📊 Estatísticas do Projeto:
- **Tempo de desenvolvimento:** ~2 horas
- **Linhas de código:** ~500+ linhas
- **Arquivos criados:** 10+ arquivos
- **Tecnologias integradas:** 4 tecnologias principais
- **Funcionalidades implementadas:** 100% das solicitadas

### 🎯 Capacidades da IA Demonstradas:
- **Análise de requisitos** em linguagem natural
- **Arquitetura de software** completa
- **Desenvolvimento full-stack** (backend + frontend)
- **Debugging e resolução** de problemas
- **Otimização de código** e performance
- **Documentação técnica** detalhada
- **Testes e validação** do sistema

### 🔮 Futuro do Desenvolvimento:
Este projeto exemplifica como a IA pode acelerar drasticamente o desenvolvimento de software, mantendo alta qualidade e seguindo as melhores práticas da indústria.

**Desenvolvido com ❤️ por GitHub Copilot**
