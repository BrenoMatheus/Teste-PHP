# Sistema de Gestão de Funcionários

Este projeto é um sistema de gestão de funcionários utilizando PHP, MySQL, e JavaScript. Ele permite o cadastro e a visualização de funcionários e empresas em um banco de dados MySQL.

## Tecnologias utilizadas

- **PHP** para backend
- **MySQL** para banco de dados
- **HTML/CSS/JavaScript** para frontend

## Estrutura do Banco de Dados

O banco de dados possui as seguintes tabelas:

1. **tbl_usuario**:
   - `id_usuario` (INT, chave primária)
   - `login` (VARCHAR(20))
   - `senha` (VARCHAR(20))

2. **tbl_empresa**:
   - `id_empresa` (INT, chave primária)
   - `nome` (VARCHAR(40))

3. **tbl_funcionario**:
   - `id_funcionario` (INT, chave primária)
   - `nome` (VARCHAR(50))
   - `cpf` (VARCHAR(11))
   - `rg` (VARCHAR(20))
   - `email` (VARCHAR(30))
   - `id_empresa` (INT, chave estrangeira referenciando `tbl_empresa.id_empresa`)

### Inserção inicial do usuário

Para realizar o login, insira o seguinte usuário na tabela `tbl_usuario`:

```sql
INSERT INTO tbl_usuario (login, senha) VALUES ('adm@mail.com', 'projeto');
