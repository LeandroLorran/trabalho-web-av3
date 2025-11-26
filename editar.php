<?php
include 'conexao.php';

$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE id = $id";
$result = $conn->query($sql);
$produto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <section class="card">
            <h2>Editar Produto</h2>
            <form action="processa.php" method="POST">
                <input type="hidden" name="acao" value="editar">
                <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required>

                <label>Preço:</label>
                <input type="number" name="preco" step="0.01" value="<?php echo $produto['preco']; ?>" required>

                <label>Categoria:</label>
                <select name="categoria_id" required>
                    <?php
                    $cats = $conn->query("SELECT * FROM categorias");
                    while($c = $cats->fetch_assoc()) {
                        $selected = ($c['id'] == $produto['categoria_id']) ? 'selected' : '';
                        echo "<option value='{$c['id']}' $selected>{$c['nome']}</option>";
                    }
                    ?>
                </select>

                <button type="submit" class="btn-success">Salvar Alterações</button>
                <a href="index.php" class="btn-delete">Cancelar</a>
            </form>
        </section>
    </main>
</body>
</html>