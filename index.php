<?php
include 'conexao.php'; // Chama a conexão com o banco

// Lógica de Exclusão (DELETE)
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $conn->query("DELETE FROM produtos WHERE id = $id");
    header("Location: index.php"); // Recarrega a página
    exit();
}

// Lógica de Listagem (READ)
// Pega os produtos e o nome da categoria relacionada
$sql = "SELECT p.*, c.nome as categoria_nome FROM produtos p JOIN categorias c ON p.categoria_id = c.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Loja - CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Gerenciamento de Produtos</h1>
        <a href="sobre.php" style="float: right; margin-top: -40px;">Sobre o Projeto</a>
    </header>

    <main class="container">
        <section class="card">
            <h2>Novo Produto</h2>
            <form action="processa.php" method="POST" onsubmit="return validarFormulario()">
                <input type="hidden" name="acao" value="cadastrar">
                
                <label>Nome do Produto:</label>
                <input type="text" id="nome" name="nome" required>

                <label>Preço (R$):</label>
                <input type="number" id="preco" name="preco" step="0.01" required>

                <label>Categoria:</label>
                <select id="categoria" name="categoria_id" required>
                    <option value="">Selecione...</option>
                    <?php
                    // Busca categorias para preencher o select
                    $cats = $conn->query("SELECT * FROM categorias");
                    while($c = $cats->fetch_assoc()) {
                        echo "<option value='{$c['id']}'>{$c['nome']}</option>";
                    }
                    ?>
                </select>

                <button type="submit" class="btn-success">Cadastrar</button>
            </form>
        </section>

        <section class="card">
            <h2>Lista de Produtos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $row['categoria_nome']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn-edit">Editar</a>
                            <a href="index.php?deletar=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>