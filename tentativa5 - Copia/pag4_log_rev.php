<?php
session_start();

$conectar = mysqli_connect("localhost", "root", "", "loginv01");
if (mysqli_connect_errno()) {
    echo "Falha ao tentar conectar: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Segurança: escape das variáveis
    $idV = mysqli_real_escape_string($conectar, $_POST['idV']);
    $nome = mysqli_real_escape_string($conectar, $_POST['nome']);
    $senha = mysqli_real_escape_string($conectar, $_POST['senha']);

    // Consulta no banco
    $sql = "SELECT * FROM vendedora WHERE idV = '$idV' AND nome = '$nome' AND senha = '$senha'";
    $resultado = mysqli_query($conectar, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Salvar dados na sessão
        $_SESSION['idV'] = $usuario['idV'];
        $_SESSION['nome'] = $usuario['nome'];

        // Redirecionar para a página protegida
        header("Location: pag5_inic_rev.php");
        exit();
    } else {
        echo "<p style='color:red;'>Alguma informação não está correta, tente novamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
   
    <link rel="stylesheet" href="principal.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="segundario.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="terciario.css?v=<?php echo time();?>">
</head>
<div id="imag">
<body>
    
<center>
    <a href="teste.php"><h1>Cuide de sí</h1></a>
    <h2>Cuide de Si — Sua beleza, seu negócio, seu momento.</h2>
    <strong><a href="pag1_principal.php">←Voltar</a></strong>
    <h2>Preencha as informações para o login revendedor(a)</h2>
    <form action="" method="POST">
        <label>ID: </label><input type="number" name="idV" id="info" required><br><br>
        <label>Nome: </label><input type="text" name="nome" id="info" required><br><br>
        <label>Senha: </label><input type="password" name="senha" required><br><br>
        <button class="cs-btn botao" type="submit"><span>Entrar</span></button>
    </form>
</div>

</center>
</body>
</html>
