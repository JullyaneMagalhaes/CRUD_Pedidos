<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>

<h1>Meus Pedidos</h1>
<form action="salvar.php" method="post">
    <label for="data">Data: </label> <input type="datetime-local" name="data" id="data">
    <label for="cliente">Cliente: </label><input type="text" name="cliente" id="cliente">
    <label for="produto">Produto: </label><input type="text" name="produto" id="produto">
    <label for="valor">Valor: </label><input type="text" name="valor" id="valor">
    <input type="submit" value="Salvar">
</form>
<hr>
<link rel="stylesheet" href="index.css">
<div
    class="table-responsive"
>
    <table
        class="table table-primary"
    >
        <thead>
            <tr>
                <th scope="col">Data</th>
                <th scope="col">Cliente</th>
                <th scope="col">Produto</th>
                <th scope="col">Valor</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>

        
            <?php
            //Conecta ao banco de dados usando PDO
            $host = 'localhost';
            $dbname = 'pedidos';
            $username = 'root';
            $password = '';

            try {
                $pdo = new PDO ("mysql:host=$host;dbname=$dbname",$username,$password);
            } catch (PDOException $e) {
                die ("Erro ao conectar ao banco de dados". $e->getMessage());
            }

            

            //Selecionar os dados da tabela Pedidos

            $sql = "SELECT * FROM pedidos";
            $stmt = $pdo-> prepare ($sql);
            $stmt -> execute();

            //Exibir pedidos em uma tabela

            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>".$row['data']."</td>";
                echo "<td>".$row['cliente']."</td>";
                echo "<td>".$row['produto']."</td>";
                echo "<td>".$row['valor']."</td>";
                echo "<td>";
                echo "<a href='editar.php?id=".$row['id']."'>Editar</a>";
                echo "<a href='excluir.php?id=".$row['id']."'>Excluir</a>";
                echo "</td>";
                echo "<tr>";
            }
            ?>



<!-- 
            <td>
            <a name='editar' id='editar' class='btn btn-warning' href='editar.php' role='button'>Editar</a>";
            <a name='excluir' id='excluir' class='btn btn-warning' href='excluir.php' role='button'>Excluir</a>";
            <td>

            
       
            <tr class="">
                <td scope="row">Item</td>
                <td>Item</td>
                <td>Item</td>
                <td>Item</td>
                <td>Item</td>
            </tr> -->
        </tbody>
    </table>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>