<?php 
$conectar = mysqli_connect("localhost", "root", "", "loginv01");

if (mysqli_connect_errno()) {/*checar a conexão*/
    echo "Falha ao tentar conectar connect to MySQL: " . mysqli_connect_error();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="principal.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="segundario.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="terciario.css?v=<?php echo time();?>" >
</head>
<div id="imag">
<body>
<center>
<br>
    
    <a href="teste.php"><h1>Cuide de sí</h1></a>
    <h2>Cuide de Si — Sua beleza, seu negócio, seu momento.</h2><strong>
    <a href="pag2_tipocadastro.php">←Voltar</a></strong>

<br><br>
<center>
    <h2>Preencha as informações para o cadastro Cliente</h2>
 <br>        
        <form action="pag3_cad_cli.php" method="POST">
                <label> CPF: </label> <input type="text" name="cpf" id="info" class id="input-estilo">
                <br><br>
                <label> Nome: </label> <input type="text" name="nome" id="info" class id="input-estilo">
                <br><br>
                <label> Email: </label> <input type="text" name="email" id="info" class id="input-estilo">
                <br><br>
                <label> Senha: </label> <input type="password" name="senha" id="info" class id="input-estilo">
                <br><br>
                <label> Confirme senha: </label> <input type="password" name="senhaconfirmada" id="info" class id="input-estilo">
                <br><br><br><br>

                <button class="cs-btn botao" type="submit"><span> Salvar </span></button>
        </form>
</center>
        <br>
<center>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {/*do banco ao sistema*/
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaconfirmada = $_POST['senhaconfirmada'];

    if (empty($cpf) || empty($nome) || empty($email) || empty($senha)) {
        echo "<p style='color:red; font-weight:bold;'>Por favor preencha todos os campo</p>";
    } elseif ($senha !== $senhaconfirmada) {
        echo "<p style='color:red;'><strong>As senhas não estão corretas</strong></p>";
    } else {
        $mysql = "INSERT INTO cliente(cpf, nome, email, senha) VALUES('$cpf', '$nome', '$email', '$senha')";
        $resultado = mysqli_query($conectar, $mysql);
     echo "Dados cadastrados com sucesso<br><br>";
        echo "<button class='cs-btn botao'> <a href='pag4_log_cli.php'><span> Entre na sua conta </span> </a></button>";
    }
}

?>