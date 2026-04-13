<?php 
$conectar = mysqli_connect("localhost", "root", "", "loginv01");

if (mysqli_connect_errno()) {
    echo "Erro ao conectar com o banco de dados: " . mysqli_connect_error();
    exit();
}

/*Deletar produto*/
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletar'])){
    $Codei = $_POST['Codei'];
    $sql = "DELETE FROM produto WHERE Codei = $Codei";

    if(mysqli_query($conectar, $sql)){
        echo"<center><p><strong>Produto deletado</strong></p></center>";
    }else{
        echo"<center><p>Erro ao deletar</p></center>";
    }
}

/*Atualizar produto*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    $Codei = $_POST['Codei'];
    $nomep = $_POST['nomep'];
    $tipo = $_POST['tipo'];
    $discricao = $_POST['discricao'];
    $disponibilidade = isset($_POST['disponibilidade']) ? 1 : 0;
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];

/*Se imagem nova foi enviada*/
if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
    $pasta = "ftprodutos/";
    $imgNome = basename($_FILES['img']['name']);
    $caminhoImg = $pasta . $imgNome;
    move_uploaded_file($_FILES['img']['tmp_name'], $caminhoImg);

$sql = "UPDATE produto SET nomep='$nomep', tipo='$tipo', discricao='$discricao', disponibilidade=$disponibilidade, 
                quantidade=$quantidade, valor=$valor, img='$caminhoImg' WHERE Codei=$Codei";
    } else {
$sql = "UPDATE produto SET nomep='$nomep', tipo='$tipo', discricao='$discricao', disponibilidade=$disponibilidade, 
                quantidade=$quantidade, valor=$valor WHERE Codei=$Codei";
    }

    if (mysqli_query($conectar, $sql)) {
       echo "<center><p class='mensagem' style='color: green;'><strong>Produto atualizado com sucesso</strong></p></center>";

    } else {
        echo "<center><p class='erro' style='color: red;><strong>Erro ao atualizar: " . mysqli_error($conectar) . "</strong></p></center>";
    }
}

/*Consultar todos os produtos*/
$sqlLista = "SELECT * FROM produto ORDER BY Codei DESC";
$resultadoLista = mysqli_query($conectar, $sqlLista);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="principal.css?v=<?php echo time();?>"> 
    <link rel="stylesheet" href="segundario.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="terciario.css?v=<?php echo time();?>">
</head>
<div id="imii">
<body>
<head>
<center>
<br>
<a href="teste.php"><h1>Cuide de Sí</h1></a>
<h2>Cuide de Si — Sua beleza, seu negócio, seu momento.</h2><strong>
    <a href="pag5_inic_rev.php">← Voltar</a></strong>
<br>
<h2>Altere os produtos</h2>
 
            <?php while($produto = mysqli_fetch_assoc($resultadoLista)) { ?>
               
                <form class="produto" method="POST" enctype="multipart/form-data">
               <div id='imii'>
                    <label>Imagem atual:</label><br>
                    <img src="<?= $produto['img'] ?>" alt="Imagem" style="width:150px;"><br><br>
                    <label>Nova imagem:</label>
                    <input type="file" name="img" accept="image/*"><br>
                    <br>  
                    <p><strong>Código do produto:</strong> <?= $produto['Codei'] ?></p>
                    <input type="hidden" name="Codei" value="<?= $produto['Codei'] ?>">
                    <input type="text" name="nomep" value="<?= htmlspecialchars($produto['nomep']) ?>" required>
                    <input type="text" name="tipo" value="<?= htmlspecialchars($produto['tipo']) ?>" required>
                    <input type="text" name="discricao" value="<?= htmlspecialchars($produto['discricao']) ?>" required>
                    <label>Disponível:</label><input type="checkbox" name="disponibilidade" value="1" <?= $produto['disponibilidade'] ? 'checked' : '' ?>>
                    <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" required>
                    <input type="number" step="0.01" name="valor" value="<?= $produto['valor'] ?>" required>
                    <br><br>
                   <button class="cs-btn botao" type="submit" name="atualizar">Atualizar</button>
                </form> 
                <br><br>
                <form class="produto" method="POST">
                <input type="hidden" name="Codei" value="<?= $produto['Codei'] ?>">    
               <button class="cs-btn botao" type="submit" name="deletar">Deletar</button>
                <hr></div></form>
            <?php } ?>
          
    </center> 
</body>
</html>
