<?php
session_start();

if (!isset($_SESSION['idV']) || !isset($_SESSION['nome'])) {
    echo "Você precisa estar logado para acessar esta página.";
    exit();
}

$idV = $_SESSION['idV'];
$nome = $_SESSION['nome'];
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
<div id="imagem">
<body>
<center>
<br>
                
    <a href="teste.php"><h1>Cuide de sí</h1></a>
    <h2>Cuide de Si — Sua beleza, seu negócio, seu momento.</h2>
    <strong><a href="pag1_principal.php">←Voltar a pagina inicial</a></strong>
    <h4>Bem-vindo(a) ao cuide revendedor(a) <?php echo $nome; ?> </h4>
    <p>Seu ID de revendedor é: <strong><?php echo $idV; ?></strong></p>

<br><br>

        <button class="cs-btn botao"><a href="pag6_prod.php"><span> Adicione Produtos </span></a></button>
        
        <button class="cs-btn botao"><a href="pag7_altera.php"><span> Altere Pordutos </span></a></button>

        <button class="cs-bnt botao"><a href="pag9_pedido.php"><span> Seus Pedidos </span></a></button>

<br>

    <h4>Informações necessárias </h4>
        <p class="textao">
                <strong>Adicione:</strong> Para adiconar um produto que você possue
                    é necessario algumas infomações como <b>Nome, Tipo de produto, Descrição do produto
                    Disponibilide do produto(caso esteja desponivel marque o quadrinho), Quantidade de produtos,
                    Valor do produto e uma imagem do mesmo.</b> Assim possibilida o cliente a ver e enteder o que
                    ele vai comprar.
        </p>
<br></div><br>
<div id='imii'><center>
        <p class="textao">
                <strong>Altere:</strong> É para modificar informações dos produtos adicionados na pagina
                    <b>Adiconar Produtos</b>, podendo alterar informações como <b>Nome, Tipo de produto, Descrição do
                        produto
                        Disponibilide do produto(caso o esteja indesponivel NÃO marque o quadrinho), Quantidade de
                        produtos,
                        Valor do produto e uma imagem do mesmo.</b>
            </p>
<br>
            <p class="textao">
                <strong>Pedidos:</strong> É uma pagina exclusivamente feita para ver os pedidos dos cliente,
                    os itens que foram escolhidos pelos mesmo, assim facilitando na hora da venda.
            </p>
</center>
</div>
</body>
</html>