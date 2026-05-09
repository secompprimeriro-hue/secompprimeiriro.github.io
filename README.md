## 🔑 **CREDENCIAIS DE ACESSO - GRUPO TEREZA GASTRONOMIA**

### 🏢 **MATRIZ (Administrador Geral - Acesso Total)**
| Campo | Valor |
|-------|-------|
| 📧 **E-mail** | `admin@teresa.com` |
| 🔒 **Senha** | `admin123` |

---

### 🏪 **FILIAIS (Gerentes de Unidade - Acesso Restrito)**

| Filial | 📧 E-mail | 🔒 Senha |
|--------|-----------|----------|
| 🍽️ **Filial Crato** | `crato@teresa.com` | `filial123` |
| 🍽️ **Filial Barbalha** | `barbalha@teresa.com` | `filial123` |

---

## 📋 **TABELA RESUMO PARA COPIAR/COLAR**

```
============================================
   PERFIL        E-MAIL              SENHA
============================================
 Matriz     admin@teresa.com      admin123
 Filial     crato@teresa.com      filial123
 Filial     barbalha@teresa.com   filial123
============================================
```

---

## 🎯 **O QUE CADA PERFIL PODE FAZER**

### 🏢 **MATRIZ (`admin@teresa.com`)**
- ✅ Dashboard completo com gráficos
- ✅ Cadastrar/editar/excluir **filiais**
- ✅ Cadastrar/editar/excluir **fornecedores**
- ✅ Visualizar vendas de **TODAS** as filiais
- ✅ Relatórios gerenciais
- ✅ Ranking de desempenho
- ✅ Análise de consumo por região
- ✅ Gerenciar usuários do sistema

### 🏪 **FILIAL (`crato@teresa.com` ou `barbalha@teresa.com`)**
- ✅ Dashboard da sua unidade
- ✅ Registrar vendas
- ✅ Visualizar estoque da sua filial
- ✅ Solicitar pedidos a fornecedores
- ✅ Ver fornecedores da sua região
- ❌ **NÃO** vê dados de outras filiais

---

## 🚀 **COMO USAR**

1. **Acesse o sistema:**
   ```
   http://localhost/teresa_gastronomia/public/index.php
   ```
   (se estiver rodando localmente com XAMPP)

2. **Digite o e-mail e a senha** conforme a tabela acima

3. **O sistema redireciona automaticamente** para o dashboard correto baseado no perfil

---

## ⚠️ **DICAS IMPORTANTES**

> 🔐 **Segurança:** Estas são contas de demonstração. Em produção, altere as senhas!

> 💡 **Teste rápido:** Use `admin@teresa.com` com `admin123` para ver todas as funcionalidades da matriz

> 📌 **Credenciais do Banco de Dados (config/database.php):**
> - Usuário: `root`
> - Senha: ` ` (vazio)
> - Banco: `teresa_gastronomia`

---

**Guardou as credenciais? Agora é só acessar e começar a usar!** 🍽️


# 📘 GUIA COMPLETO: Como Instalar Banco de Dados MySQL e Configurar o Projeto

## 🎥 **VÍDEOS DE APOIO RECOMENDADOS**

### Para aprender MySQL e phpMyAdmin:

| Tema | Link do Vídeo | Descrição |
|------|---------------|-----------|
| **Curso de MySQL - Básico ao Avançado** | https://www.youtube.com/watch?v=Ofktsne-utM | Curso completo do Curso em Vídeo |
| **PHP com MySQL - Criando Banco de Dados** | https://www.youtube.com/watch?v=ZZloa3C_VL4 | Conectando PHP ao MySQL |
| **Instalar XAMPP e phpMyAdmin** | https://www.youtube.com/watch?v=n39CcGTT12I | Passo a passo completo |
| **Importar arquivo .sql no phpMyAdmin** | https://www.youtube.com/watch?v=8eSvnKqndMU | Como restaurar bancos de dados |

---

## 📦 **PARTE 1: INSTALANDO O BANCO DE DADOS (MySQL)**

### Opção 1: Usando XAMPP (Mais fácil - RECOMENDADO)

#### Passo 1: Baixar e instalar o XAMPP

1. Acesse: https://www.apachefriends.org/
2. Clique em **"Download"** para Windows
3. Execute o instalador
4. Clique em "Next" em todas as telas
5. Mantenha os componentes marcados:
   - ✅ **Apache** (servidor web)
   - ✅ **MySQL** (banco de dados)
   - ✅ **PHP** (linguagem)
   - ✅ **phpMyAdmin** (gerenciador visual)
6. Pasta de instalação: `C:\xampp`
7. Conclua a instalação

#### Passo 2: Iniciar o MySQL

1. Abra o **XAMPP Control Panel** (ícone no desktop/menu iniciar)
2. Clique em **"Start"** ao lado de:
   - ✅ **Apache** (porta 80)
   - ✅ **MySQL** (porta 3306)
3. As barras ficarão **VERDES** quando tudo estiver funcionando

![XAMPP Control Panel](https://i.imgur.com/example.png)

✅ **Verificação:** Abra o navegador e digite `http://localhost/phpmyadmin`

---

### Opção 2: Instalar MySQL separadamente

#### Passo 1: Download do MySQL Community Server

1. Acesse: https://dev.mysql.com/downloads/mysql/
2. Escolha o sistema operacional (Windows)
3. Baixe o instalador: `mysql-installer-web-community-8.x.xx.msi`

#### Passo 2: Instalação

1. Execute o instalador
2. Escolha **"Developer Default"**
3. Clique em "Next" e "Execute" para instalar os componentes
4. Configure:
   - **Root Password:** Digite uma senha forte (e NÃO ESQUEÇA!)
   - Anote a senha em um local seguro
5. Conclua a instalação

---

## 🗄️ **PARTE 2: CRIANDO O BANCO DE DADOS**

### Método 1: Usando phpMyAdmin (Visual - RECOMENDADO)

#### Passo 1: Acessar o phpMyAdmin

```
http://localhost/phpmyadmin
```

#### Passo 2: Criar o Banco de Dados

1. Clique em **"Novo"** no menu lateral esquerdo
2. Digite o nome do banco: `teresa_gastronomia`
3. **Collation:** escolha `utf8_general_ci` ou `utf8mb4_general_ci`
4. Clique em **"Criar"**

![Criar banco de dados](https://i.imgur.com/create_db.png)

#### Passo 3: Importar o arquivo SQL

1. Clique no banco `teresa_gastronomia` (menu esquerdo)
2. Clique na aba **"Importar"** (topo da página)
3. Clique em **"Escolher arquivo"** ou **"Browse"**
4. Navegue até: `C:\xampp\htdocs\teresa_gastronomia\sql\database.sql`
5. Mantenha as configurações padrão:
   - Formato: **SQL**
   - Codificação: **utf-8**
6. Clique em **"Importar"** no final da página

✅ **Sucesso!** Você verá a mensagem: "A importação foi concluída com sucesso"

As tabelas criadas serão:
- `usuarios` → armazena logins
- `filiais` → dados das unidades
- `fornecedores` → parceiros
- `produtos` → itens do cardápio
- `vendas` → transações
- `estoque` → controle de produtos
- `pedidos` → solicitações

---

### Método 2: Usando Linha de Comando (MySQL CLI - Avançado)

#### Abrir o MySQL:

```
# No XAMPP:
C:\xampp\mysql\bin\mysql -u root -p

# No MySQL puro:
mysql -u root -p
```

#### Comandos para criar e importar:

```sql
-- Criar o banco de dados
CREATE DATABASE teresa_gastronomia;
USE teresa_gastronomia;

-- Importar o arquivo SQL
SOURCE C:/xampp/htdocs/teresa_gastronomia/sql/database.sql;

-- Verificar se as tabelas foram criadas
SHOW TABLES;
```

#### Saída esperada:
```
+-------------------------------+
| Tables_in_teresa_gastronomia |
+-------------------------------+
| usuarios                      |
| filiais                       |
| fornecedores                  |
| produtos                      |
| vendas                        |
| estoque                       |
| pedidos                       |
| pedido_itens                  |
+-------------------------------+
```

---

## 🔌 **PARTE 3: CONFIGURANDO O PROJETO PARA CONECTAR AO BANCO**

### Localize e edite o arquivo: `config/database.php`

O arquivo já vem com as configurações padrão do XAMPP:

```php
<?php
class Database {
    private $host = "localhost";
    private $db_name = "teresa_gastronomia";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                  $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
            return $this->conn;
        } catch(PDOException $exception) {
            return null;
        }
    }
}
?>
```

### ⚠️ **Configurações importantes:**

| Parâmetro | XAMPP | MySQL Puro | O que fazer |
|-----------|-------|------------|-------------|
| **host** | `localhost` | `localhost` ou `127.0.0.1` | Mantenha `localhost` |
| **db_name** | `teresa_gastronomia` | `teresa_gastronomia` | Nome que você criou |
| **username** | `root` | `root` ou seu usuário | Altere se necessário |
| **password** | `""` (vazio) | `"sua_senha"` | **IMPORTANTE:** Se você definiu senha no MySQL, coloque-a aqui! |

---

## ✅ **PARTE 4: TESTANDO A CONEXÃO**

### Teste Rápido: Criar um arquivo `teste_conexao.php`

```php
<?php
// Salve como: C:\xampp\htdocs\teresa_gastronomia\teste_conexao.php

require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

if($conn) {
    echo "<h2 style='color: green;'>✅ Conexão com o banco de dados realizada com SUCESSO!</h2>";
    
    // Testar se as tabelas existem
    $result = $conn->query("SHOW TABLES");
    echo "<h3>📋 Tabelas encontradas:</h3><ul>";
    while($row = $result->fetch(PDO::FETCH_NUM)) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<h2 style='color: red;'>❌ ERRO: Falha na conexão com o banco de dados!</h2>";
    echo "<p>Verifique suas configurações em config/database.php</p>";
}
?>
```

**Acesse no navegador:** `http://localhost/teresa_gastronomia/teste_conexao.php`

### Resultado esperado:

```
✅ Conexão com o banco de dados realizada com SUCESSO!

📋 Tabelas encontradas:
- usuarios
- filiais
- fornecedores
- produtos
- vendas
- estoque
- pedidos
- pedido_itens
```

---

## 🐛 **PARTE 5: RESOLVENDO PROBLEMAS COMUNS**

### Problema 1: "Access denied for user 'root'@'localhost'"

**Causa:** Senha do MySQL incorreta ou não configurada

**Solução:**
```php
// No XAMPP, a senha geralmente é vazia
private $password = "";

// Se você definiu uma senha, coloque-a
private $password = "sua_senha_aqui";
```

### Problema 2: "Unknown database 'teresa_gastronomia'"

**Causa:** O banco de dados não foi criado

**Solução:**
1. Acesse `http://localhost/phpmyadmin`
2. Verifique se o banco `teresa_gastronomia` existe
3. Se não existir, crie-o e importe o arquivo SQL

### Problema 3: O Apache ou MySQL não inicia (porta ocupada)

**Causa:** Skype ou outros programas usam a mesma porta

**Solução para Apache (porta 80):**
1. XAMPP Control Panel → Apache → Config → httpd.conf
2. Procure por `Listen 80` e mude para `Listen 8080`
3. Acesse: `http://localhost:8080`

**Solução para MySQL (porta 3306):**
1. Feche o Skype completamente
2. Ou vá em Config → MySQL → my.ini
3. Mude `port=3306` para `port=3307`

### Problema 4: Erro de charset/caracteres especiais

**Solução:** Garanta que o banco está com encoding utf8

```sql
ALTER DATABASE teresa_gastronomia CHARACTER SET utf8 COLLATE utf8_general_ci;
```

---

## 📂 **PARTE 6: ESTRUTURA FINAL DO PROJETO**

Após tudo configurado, sua pasta deve ficar assim:

```
C:\xampp\htdocs\
└── teresa_gastronomia\
    ├── index.html
    ├── public\
    │   ├── index.php
    │   └── assets\
    ├── app\
    │   ├── controllers\
    │   ├── models\
    │   └── views\
    ├── config\
    │   └── database.php      ← CONFIGURAÇÃO DO BANCO
    └── sql\
        └── database.sql       ← ARQUIVO PARA IMPORTAR
```

---

## 🚀 **PARTE 7: ACESSANDO O SISTEMA COMPLETO**

### Passo 1: Iniciar os serviços

- Apache: **Start**
- MySQL: **Start**

### Passo 2: Acessar no navegador

```
http://localhost/teresa_gastronomia/public/index.php
```

### Passo 3: Fazer login com as credenciais

| Perfil | E-mail | Senha |
|--------|--------|-------|
| Matriz | `admin@teresa.com` | `admin123` |
| Filial | `crato@teresa.com` | `filial123` |

---

## 📚 **RESUMO DOS COMANDOS ÚTEIS**

| Comando | O que faz |
|---------|-----------|
| `http://localhost/phpmyadmin` | Acessar gerenciador do banco |
| `http://localhost/teresa_gastronomia/public/` | Acessar o sistema |
| `C:\xampp\mysql\bin\mysql -u root -p` | Abrir MySQL no terminal |
| `SHOW DATABASES;` | Listar bancos (no MySQL) |
| `USE teresa_gastronomia;` | Selecionar o banco |
| `SHOW TABLES;` | Listar tabelas |
| `SELECT * FROM usuarios;` | Ver usuários cadastrados |

---

## 🎯 **CHECKLIST DE VERIFICAÇÃO**

- [ ] XAMPP instalado
- [ ] Apache está rodando (verde no painel)
- [ ] MySQL está rodando (verde no painel)
- [ ] Banco `teresa_gastronomia` criado
- [ ] Arquivo `database.sql` importado com sucesso
- [ ] Arquivo `config/database.php` com dados corretos
- [ ] `teste_conexao.php` mostra sucesso
- [ ] Sistema acessível em `http://localhost/teresa_gastronomia/public/`
- [ ] Login funciona com as credenciais fornecidas

---

## 🆘 **AINDA COM PROBLEMAS?**

### Verifique:

1. **O MySQL está rodando?**
   - Painel do XAMPP → MySQL deve estar VERDE

2. **O banco foi criado?**
   - `http://localhost/phpmyadmin` → `teresa_gastronomia` deve aparecer

3. **As tabelas foram importadas?**
   - Dentro do banco deve ter pelo menos 8 tabelas

4. **O arquivo database.php está correto?**
   - Verifique usuário = `root`, senha = `""` (XAMPP)

5. **O projeto está dentro do htdocs?**
   - `C:\xampp\htdocs\teresa_gastronomia\`

---

## 📺 **VÍDEOS COMPLEMENTARES RECOMENDADOS**

1. **Curso de MySQL Completo (Curso em Vídeo)**
   - Link: https://www.youtube.com/watch?v=Ofktsne-utM
   - Aprenda desde o zero comandos SQL

2. **PHP com MySQL - Criando Banco de Dados**
   - Link: https://www.youtube.com/watch?v=ZZloa3C_VL4
   - Conectando PHP ao banco de dados

3. **Importar arquivo .sql no phpMyAdmin**
   - Link: https://www.youtube.com/watch?v=8eSvnKqndMU
   - Como restaurar bancos de dados

4. **Instalar XAMPP e configurar ambiente PHP**
   - Link: https://www.youtube.com/watch?v=n39CcGTT12I
   - Passo a passo completo para iniciantes

---

**✨ Com este guia completo, você conseguirá configurar o banco de dados e rodar o sistema Grupo Tereza Gastronomia sem problemas!** 🚀

> **Arquivo salvo como:** `GUIA_BANCO_DADOS_PASSO_A_PASSO.txt`