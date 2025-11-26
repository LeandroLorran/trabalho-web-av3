<?php
include 'conexao.php';

// Verifica se veio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria_id = $_POST['categoria_id'];
    $acao = $_POST['acao'];

    if ($acao == 'cadastrar') {
        // CREATE
        $sql = "INSERT INTO produtos (nome, preco, categoria_id) VALUES ('$nome', '$preco', '$categoria_id')";
        $conn->query($sql);
    } 
    elseif ($acao == 'editar') {
        // UPDATE
        $id = $_POST['id'];
        $sql = "UPDATE produtos SET nome='$nome', preco='$preco', categoria_id='$categoria_id' WHERE id=$id";
        $conn->query($sql);
    }

    // Volta para o index
    header("Location: index.php");
    exit();
}
?>