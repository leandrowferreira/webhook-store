# 🚀 GitHub Actions Workflows

Este projeto utiliza GitHub Actions para automatizar testes, verificações de qualidade e releases. Aqui está uma visão geral dos workflows configurados:

## 📋 Workflows Disponíveis

### 1. 🧪 **Tests** (`tests.yml`)
**Trigger:** Push para `main`/`develop`, Pull Requests, Manual
**Propósito:** Execução completa da suíte de testes

#### Jobs:
- **🧪 Tests Matrix**: Testa múltiplas versões do PHP (8.2, 8.3) com diferentes estratégias de dependências
- **🔍 Code Quality**: Executa Laravel Pint e análise estática (PHPStan se disponível)
- **🔒 Security**: Auditoria de segurança das dependências
- **🚀 Deploy Readiness**: Verifica se a aplicação está pronta para deploy (apenas em PRs para main)

#### Features:
- ✅ Cache de dependências Composer
- ✅ Matriz de testes (PHP 8.2, 8.3)
- ✅ Upload de artefatos em caso de falha
- ✅ Otimização de autoloader para deploy

---

### 2. 🛡️ **Branch Protection** (`branch-protection.yml`)
**Trigger:** Pull Requests para `main`
**Propósito:** Verificações de qualidade do PR e branch

#### Jobs:
- **🛡️ Branch Protection**: Verifica convenções de nome de branch e conflitos
- **📏 PR Size Check**: Analisa tamanho do PR e sugere divisão se necessário
- **🏷️ Auto Label**: Aplica labels automaticamente baseado nos arquivos alterados

#### Features:
- ✅ Verificação de convenções semânticas (feature/, bugfix/, hotfix/, release/)
- ✅ Detecção de conflitos de merge
- ✅ Análise de mensagens de commit
- ✅ Aplicação automática de labels

---

### 3. 📊 **Code Coverage** (`coverage.yml`)
**Trigger:** Push para `main`, Pull Requests
**Propósito:** Medição de cobertura de código e métricas

#### Jobs:
- **📈 Test Coverage**: Gera relatórios de cobertura com Xdebug
- **📏 Code Metrics**: Calcula métricas de código (LOC, ratio de testes)
- **⚡ Performance Check**: Monitora tempo de execução dos testes

#### Features:
- ✅ Cobertura HTML e XML
- ✅ Upload para Codecov
- ✅ Métricas no GitHub Summary
- ✅ Monitoramento de performance

---

### 4. 🚀 **Release** (`release.yml`)
**Trigger:** Tags `v*`
**Propósito:** Criação automática de releases

#### Jobs:
- **🎉 Create Release**: Cria release no GitHub com changelog automático

#### Features:
- ✅ Changelog automático baseado em commits
- ✅ Estatísticas de mudanças por tipo
- ✅ Arquivo de release otimizado
- ✅ Execução final de testes

---

## 🔧 Configuração

### Requisitos:
- PHP 8.2+ 
- Composer
- SQLite
- Laravel 11+
- Pest Testing Framework

### Dependências dos Workflows:
- `shivammathur/setup-php@v2`
- `actions/checkout@v4`
- `actions/cache@v3`
- `actions/upload-artifact@v3`
- `codecov/codecov-action@v3`

## 🎯 Melhores Práticas Implementadas

### ✅ **Quando os Testes Executam:**
1. **Pull Request** - Abertura e atualizações
2. **Push para main/develop** - Após merge
3. **Push para feature branches** - Desenvolvimento contínuo
4. **Manual** - Quando necessário

### ✅ **Estratégias de Qualidade:**
- **Matriz de PHP**: Testa compatibilidade com versões 8.2 e 8.3
- **Múltiplas estratégias**: prefer-lowest e prefer-stable
- **Cache inteligente**: Acelera execução dos workflows
- **Fail-fast**: Para execução rápida em caso de falhas

### ✅ **Segurança:**
- Auditoria automática de dependências
- Verificação de conflitos de merge
- Análise de tamanho de PRs
- Validação de convenções de branch

### ✅ **Monitoramento:**
- Cobertura de código com Codecov
- Métricas de performance
- Estatísticas de código
- Alertas de PRs grandes

## 📊 Status Badges

Adicione estes badges ao seu README principal:

```markdown
[![Tests](https://github.com/leandrowferreira/webhook-store/actions/workflows/tests.yml/badge.svg)](https://github.com/leandrowferreira/webhook-store/actions/workflows/tests.yml)
[![Code Coverage](https://github.com/leandrowferreira/webhook-store/actions/workflows/coverage.yml/badge.svg)](https://github.com/leandrowferreira/webhook-store/actions/workflows/coverage.yml)
[![codecov](https://codecov.io/gh/leandrowferreira/webhook-store/branch/main/graph/badge.svg)](https://codecov.io/gh/leandrowferreira/webhook-store)
```

## 🚀 Como Usar

### Para Desenvolvimento:
1. Crie uma branch seguindo a convenção: `feature/nome-da-feature`
2. Faça commits seguindo Conventional Commits
3. Abra um Pull Request para `main`
4. Os workflows executarão automaticamente

### Para Release:
1. Faça merge do PR para `main`
2. Crie uma tag: `git tag v1.1.0`
3. Push da tag: `git push origin v1.1.0`
4. O release será criado automaticamente

## 🔍 Troubleshooting

### Testes falhando:
1. Verifique se todas as dependências estão instaladas
2. Confirme que o banco SQLite está configurado
3. Verifique se as migrations estão atualizadas

### Workflow não executando:
1. Verifique se o trigger está correto
2. Confirme permissões do repositório
3. Verifique se há conflitos de merge

### Coverage não funcionando:
1. Confirme que Xdebug está instalado
2. Verifique se o Codecov está configurado
3. Confirme que os testes estão passando

---

**💡 Dica:** Monitore a aba "Actions" no GitHub para acompanhar a execução dos workflows e identificar possíveis problemas.
