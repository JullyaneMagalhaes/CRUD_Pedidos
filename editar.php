<?php

$host = 'localhost';
$dbname = 'pedidos';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM pedidos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$pedido = $stmt->fetch();

if (!$pedido) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $data = $_POST['data'];
    $cliente = $_POST['cliente'];
    $produto = $_POST['produto'];
    $valor = $_POST['valor'];

$sql = "UPDATE pedidos SET data=:data, cliente=:cliente,produto=:produto,
valor=:valor WHERE id=:id";
$stmt = $pdo ->prepare($sql);
$stmt->bindValue(':data',$data);
$stmt->bindValue(':cliente',$cliente);
$stmt->bindValue(':produto',$produto);
$stmt->bindValue(':valor',$valor);
$stmt->bindValue(':id',$id);
$stmt->execute();

header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="pedidos.css">
</head>
<body>
    <h1><blockquote>Editar Pedidos</blockquote></h1>
    <form action="editar.php?id=<?php echo $id;?>" method="post">
    <label>Data:</label>
    <input type="text" name="data" value="<?php echo $pedido['data'];?>"><br>
    <p></p>
    <label>Cliente:</label>
    <input type="text" name="cliente" value="<?php echo $pedido['cliente'];?>"><br>
    <p></p>
    <label>Produto:</label>
    <input type="text" name="produto" value="<?php echo $pedido['produto'];?>"><br>
    <p></p>
    <label>Valor:</label>
    <input type="text" name="valor" value="<?php echo $pedido['valor'];?>"><br>
    <p></p>
    <input type="Submit" value="Salvar Alterações" class="alterações">
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
