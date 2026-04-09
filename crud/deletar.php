<?php
// ------------------------------------------------------------
// ARQUIVO: deletar.php
// RESPONSABILIDADE:
// Receber o id por GET e remover o usuario correspondente.
// ------------------------------------------------------------

// Inclui conexao com banco.
include 'conexao.php';

// Verifica se o id foi enviado pela URL.
if (isset($_GET['id'])) {
    // Captura do id informado.
    $id = $_GET['id'];

    // Monta SQL de exclusao.
    $sql = "DELETE FROM usuarios WHERE id = $id";

    // Executa exclusao e redireciona para listagem em caso de sucesso.
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        // Em caso de erro, exibe mensagem simples.
        // Em aula, voce pode evoluir para alerta Bootstrap com redirecionamento.
        echo "Erro ao excluir: " . mysqli_error($conn);
    }
}
?>