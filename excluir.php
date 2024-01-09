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

    $sql ="SELECT * FROM pedidos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->execute();
    $pedido = $stmt->fetch();

    if (!$pedido) {
        header('Location: index.php');
        exit();
    }

    $sql ="DELETE FROM pedidos WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->execute();

    header('Location: index.php');
    exit();

?>