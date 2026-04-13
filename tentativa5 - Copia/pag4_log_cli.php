<?php /*conectar com o bd*/
session_start();

$conectar = mysqli_connect("localhost","root","","loginv01"); /*conectar ao banco*/

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
    <link rel="stylesheet" href="terciario.css?v=<?php echo time();?>">
</head>
<div id="imag">
<body>
<center>
<br>
    <a href="teste.php"><h1>Cuide de sí</h1></a>
    <h2>Cuide de Si — Sua beleza, seu negócio, seu momento.</h2><strong>
    <a href="pag1_principal.php">← Voltar</a></strong>

<br><br>
<center>
    
<h2>Preencha as informações para o login cliente</h2>
<br>
    <form action="pag4_log_cli.php" method="POST">
        <label> CPF: </label>  <input type="text" name="cpf" id="info">
        <br><br>
        <label> Nome: </label>  <input type="text" name="nome" id="info">
        <br><br>
        <label> Senha: </label> <input type="text" name="senha"><br>
        <br><br>
        <Label> Revendedor: </Label> <input type="number" name="idV" class id="info">
<br><br>
        <button class="cs-btn botao" type="submit" ><span> Entrar </span></button>
    </form>
</center>
<br>
</div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ /*acesso de info no bd*/

    /*evitar problemas de entrada e saida*/
    $cpf = mysqli_real_escape_string($conectar, $_POST['cpf']);
    $nome = mysqli_real_escape_string($conectar, $_POST['nome']);
    $senha = mysqli_real_escape_string($conectar, $_POST['senha']);
    $idV = mysqli_real_escape_string($conectar, $_POST['idV']);
    
    $verificar1 = mysqli_query($conectar, "SELECT * FROM vendedora WHERE idV = '$idV'");/*existencia da vendedora*/
    $verificar2 = mysqli_query($conectar, "SELECT * FROM cliente WHERE cpf = '$cpf'");/*existencia cliente*/

    $_SESSION['cpf'] = $cpf;

    if (mysqli_num_rows($verificar1) > 0) { /*atualizar o cadastro do cliente*/
        if (mysqli_num_rows($verificar2) > 0) {
            $updateSql = "UPDATE cliente SET idV = '$idV' WHERE cpf = '$cpf'"; /*id atualiazo*/

            if (mysqli_query($conectar, $updateSql)) {
                echo"<div id=imii>";
                echo "<center><p><strong>Cliente atualizado com sucesso</strong></p></center";
                header("Location: pag5_inic_cli.php");
                echo"</div>";
            } else {
                echo "Erro ao atualizar cliente: " . mysqli_error($conectar);  
            }  }else {
                echo "Erro" . mysqli_error($conectar);
            }  }else{
                echo "Erro no cogido do revendedor " . mysqli_error($conectar);
            } 
        }
?>