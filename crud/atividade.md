## Tema
Agenda de Alunos com Notas e Medias (CRUD + Calculos)

## Contexto
Vocês vao criar uma extensao do projeto atual (CRUD de usuarios) para controlar *notas de alunos* e praticar operacoes matematicas em PHP:

A ideia e montar uma pequena agenda academica com alunos, notas por bimestre, media e situacao.

## Objetivos de Aprendizagem
- Criar e relacionar tabelas no MySQL.
- Trabalhar com formularios HTML + Bootstrap 5.
- Salvar e listar dados no PHP com MySQLi.
- Aplicar funcoes/operacoes matematicas para calcular resultados.
- Exibir feedback visual de sucesso/erro.

---

## Parte 1 - Banco de Dados
Crie a tabela notas_alunos no mesmo banco do projeto.

### Exercicio 1
Crie a tabela notas_alunos com os campos:
- id (PK, auto incremento)
- aluno_id (inteiro, obrigatorio)
- bimestre (varchar 20)
- nota1 (decimal 5,2)
- nota2 (decimal 5,2)
- nota3 (decimal 5,2)
- peso (decimal 4,2, padrao 1.00)
- faltas (inteiro, padrao 0)
- created_at (timestamp, default current_timestamp)

### Exercicio 2
Adicione a chave estrangeira de aluno_id para usuarios(id).

---

## Parte 2 - Telas e Navegacao
### Exercicio 3
Adicione no menu uma nova pagina chamada *Notas*.

### Exercicio 4
Crie notas_form.php com formulario Bootstrap para cadastrar notas:
- aluno (select carregado da tabela usuarios)
- bimestre
- nota1, nota2, nota3
- peso
- faltas

---

## Parte 3 - Regras de Calculo
Implemente os calculos no backend (arquivo notas_salvar.php).

### Exercicio 5
Calcule e exiba na listagem:
- soma_notas = nota1 + nota2 + nota3
- media_simples = soma_notas / 3

### Exercicio 6
Calcule tambem a media ponderada:
- media_ponderada = ((nota1 + nota2 + nota3) / 3) * peso

### Exercicio 7
Exiba a diferenca para meta 7.0:
- diferenca_meta = 7.0 - media_simples
- Se a media for maior ou igual a 7, mostrar 0.

### Exercicio 8
Classifique o aluno:
- Aprovado: media >= 7.0 e faltas <= 10
- Recuperacao: media entre 5.0 e 6.99
- Reprovado: media < 5.0 ou faltas > 10

---

## Parte 4 - Listagem e Relatorios
### Exercicio 9
Crie notas_index.php com tabela Bootstrap mostrando:
- Nome do aluno
- Bimestre
- Nota1, Nota2, Nota3
- Soma
- Media simples
- Media ponderada
- Faltas
- Situacao

### Exercicio 10
No topo da tabela, mostre cards com resumo:
- Quantidade total de lancamentos
- Maior media da turma
- Menor media da turma
- Media geral da turma

---

## Parte 5 - Extras (Bonus)
### Exercicio 11 (bonus)
Permita editar um lancamento de notas (notas_editar.php + notas_atualizar.php).

### Exercicio 12 (bonus)
Permita excluir um lancamento (notas_deletar.php) com confirmacao.