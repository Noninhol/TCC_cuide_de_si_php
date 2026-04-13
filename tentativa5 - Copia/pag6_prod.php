<?php
$conectar = mysqli_connect("localhost", "root", "", "loginv01");

if (mysqli_connect_errno()) {
    echo "Erro ao conectar com o banco de dados: " . mysqli_connect_error();
    exit();
}
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
<body>
<div id="i">
<br>
<center>
        <a href="teste.php"><h1>Cuide de Sí</h1></a>
        <h2>Cuide de Si — Sua beleza, seu negócio, seu momento.</h2>
        <strong><a href="pag5_inic_rev.php">←Voltar</a></strong>
            
<br><br><br><br>
            
        <h2>Cadastre os produtos</h2>
<br><br>
            <form action="pag6_prod.php" method="POST" enctype="multipart/form-data">
                <label>Nome: </label><input type="text" name="nomep" required>
                <label>Tipo: </label><input type="text" name="tipo" required>
                <label>Sobre: </label><input type="text" name="discricao" required>
                <br><br><br>
                <label>Disponível: </label><input type="checkbox" name="disponibilidade" value="1">
                <label>Quantia: </label><input type="text" name="quantidade" required>
                <label>Preço(R$): </label><input type="number" step="0.01" name="valor" required>
                <br><br><br>
                <label>Imagem:</label><input type="file" name="img" accept="image/*" required>
<br><br>

                <p class="textao">
                    <strong>Atenção:</strong> Se o produto estiver disponivel marque o quadrinho,
                        caso contrario deixe ele vazio.
                </p>
<br>
                    <button class="cs-btn botao" type="submit"><span>Salvar</span></button>
            </form>
<br><br>

<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomep = $_POST['nomep'];
        $tipo = $_POST['tipo'];
        $discricao = $_POST['discricao'];
        $disponibilidade = isset($_POST['disponibilidade']) ? 1 : 0;
        $quantidade = $_POST['quantidade'];
        $valor = $_POST['valor'];

        /* Processa a imagem*/
    if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
        $pasta = "ftprodutos/";
            if (!is_dir($pasta)) {
                    mkdir($pasta, 0777, true); /*cria a pasta se nao existir*/
                    }

$imgNome = basename($_FILES['img']['name']);
$caminhoImg = $pasta . $imgNome;

    if (move_uploaded_file($_FILES['img']['tmp_name'], $caminhoImg)) {
                        
$mysql = "INSERT INTO produto (nomep, tipo, discricao, disponibilidade, quantidade, valor, img)
          VALUES ('$nomep', '$tipo', '$discricao', $disponibilidade, $quantidade, $valor, '$caminhoImg')";

$resultado = mysqli_query($conectar, $mysql);

        if ($resultado) { echo"<div id='imii'>";
                            echo "produtos salvos com sucesso<br><br>";
                            echo "<button class='cs-btn botao'> <a href='pag7_altera.php'><span> Alterar produtos</span> </a></button>";
                            echo"</div>";
        } else {
                            echo "Erro ao cadastrar no banco: " . mysqli_error($conectar);
                }
        } else {
                        echo "Erro ao mover o arquivo de imagem.";
                }
        } else {
                    echo "Imagem não enviada corretamente.";
                }
}
?>

</center>
</div>
</body>
</html>