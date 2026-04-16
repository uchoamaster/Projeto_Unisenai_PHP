-- --------------------------------------------------------
-- Exercicio 1: Criar tabela notas_alunos
-- Exercicio 2: Chave estrangeira aluno_id -> usuarios(id)
-- --------------------------------------------------------

CREATE TABLE `notas_alunos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aluno_id` int(11) NOT NULL,
  `bimestre` varchar(20) NOT NULL,
  `nota1` decimal(5,2) NOT NULL,
  `nota2` decimal(5,2) NOT NULL,
  `nota3` decimal(5,2) NOT NULL,
  `peso` decimal(4,2) NOT NULL DEFAULT 1.00,
  `faltas` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_aluno` (`aluno_id`),
  CONSTRAINT `fk_aluno` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
