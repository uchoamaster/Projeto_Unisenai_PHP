# Projeto_Unisenai_PHP

Estrutura inicial basica de CRUD em PHP puro, com Bootstrap 5 e Bootstrap Icons.

## Estrutura de diretorios

```text
crud/
	actions/
		salvar.php
		atualizar.php
		deletar.php
	includes/
		header.php
		footer.php
	pages/
		form.php
		editar.php
	conexao.php
	index.php
	usuarios.sql
```

## Como ficou organizado

- `index.php`: listagem principal.
- `pages/`: telas (formulario de cadastro e edicao).
- `actions/`: acoes do CRUD (salvar, atualizar, deletar).
- `includes/`: layout fatiado com `header.php` e `footer.php`.
- `conexao.php`: conexao com banco de dados.

## Layout fatiado

O `header.php` concentra:

- HTML inicial (`doctype`, `head`, `body`)
- Bootstrap 5 e Bootstrap Icons
- abertura do container

O `footer.php` concentra:

- fechamento do container e do HTML
- script do Bootstrap