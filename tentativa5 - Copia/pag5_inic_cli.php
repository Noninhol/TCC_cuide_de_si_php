<?php
session_start();

$cpf = $_SESSION['cpf'] ?? null;

$conectar = mysqli_connect("localhost", "root", "", "loginv01");

if (mysqli_connect_errno()) {
    echo "Falha ao tentar conectar ao MySQL: " . mysqli_connect_error();
    exit();
}

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Codei'])) {
    if (!$cpf) {
        $mensagem = "<p style='color:red;'>Você precisa estar logado para adicionar ao carrinho.</p>";
    } else {
        $Codei = intval($_POST['Codei']);

        // Verifica se o cliente existe
        $verifica1 = mysqli_query($conectar, "SELECT cpf FROM cliente WHERE cpf = '" . mysqli_real_escape_string($conectar, $cpf) . "'");

        // Verifica se o produto existe e está disponível
        $verifica2 = mysqli_query($conectar, "SELECT Codei, disponibilidade FROM produto WHERE Codei = $Codei");

        if (mysqli_num_rows($verifica1) > 0 && mysqli_num_rows($verifica2) > 0) {
            $produto = mysqli_fetch_assoc($verifica2);
            if ($produto['disponibilidade']) {
                // Insere no carrinho
                $inserir = mysqli_query($conectar, "INSERT INTO carrinho (cpf, Codei) VALUES ('" . mysqli_real_escape_string($conectar, $cpf) . "', $Codei)");

                if ($inserir) {
                    $mensagem = "<p style='color:green;'>Produto adicionado ao carrinho com sucesso!</p>";
                } else {
                    $mensagem = "<p style='color:red;'>Erro ao adicionar o produto ao carrinho.</p>";
                }
            } else {
                $mensagem = "<p style='color:red;'>Produto indisponível.</p>";
            }
        } else {
            $mensagem = "<p style='color:red;'>Cliente ou produto não encontrado.</p>";
        }
    }
}

/* Buscar produtos */
if (isset($_GET['busca']) && !empty($_GET['busca'])) {
    $busca = mysqli_real_escape_string($conectar, $_GET['busca']);
    $sqlLista = "SELECT * FROM produto WHERE nomep LIKE '%$busca%' OR tipo LIKE '%$busca%'";
} else {
    $sqlLista = "SELECT * FROM produto";
}
$resultadoProduto = mysqli_query($conectar, $sqlLista);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="principal.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="terciario.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="quinternario.css?v=<?php echo time();?>">
    <div id="aim">
</head>
<body>
<center>

    <a href="teste.php"><h1>Cuide de Sí</h1></a>
    <h2>Cuide de Si — Sua beleza, seu negócio, seu momento.</h2>
    <strong><a href="pag4_log_cli.php">←Voltar</a></strong>
    <h2>Veja nossos produtos</h2>
<br>
            <button class="cs-btn botao"  type="submit"><a href="pag8_car.php"> Carrinho </a></button>
            <br><br><br>
            <form method="GET" action="">
            <input type="text" name="busca" placeholder="Pesquisar produto..." value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
            <button class="cs-btn botao" type="submit">Pesquisar</button>
            
            <?php if (isset($_GET['busca']) && !empty($_GET['busca'])): ?>
       <button class="cs-btn botao"  type="submit"><a href="pag5_inic_cli.php"> Todos os itens </a></button>
    <?php endif; ?>
        </form>
</div>
</center>
<div id="imii">
        <div class="listap">
            <?php while ($produto = mysqli_fetch_assoc($resultadoProduto)) { ?>
                <div class="itens">
                    <img class="imagem" src="<?= htmlspecialchars($produto['img']); ?>" alt="Imagem do produto">
                    <p class="descricao"><strong>Descrição:</strong> <?= htmlspecialchars($produto['discricao']); ?></p>
                    <br>
                    <p class="discricao">
                        <?= $produto['disponibilidade'] ? 'Produto Disponível' : '<span style="color:red;">Produto INDISPONÍVEL</span>'; ?><br>
                         <strong>Nome:</strong> <?= htmlspecialchars($produto['nomep']); ?><br>
                        <strong>Tipo:</strong> <?= htmlspecialchars($produto['tipo']); ?><br>
                        <strong>Valor:</strong> R$ <?= number_format($produto['valor'], 2, ',', '.'); ?><br>
                        <strong>Quantidade:</strong> <?= intval($produto['quantidade']); ?>
                    </p>
                    <form method="POST" action="">
                        <input type="hidden" name="Codei" value="<?= intval($produto['Codei']); ?>">
                        <button type="submit" name="carrinho" class="cs-btn botao" <?= !$produto['disponibilidade'] ? 'disabled' : '' ?>>
                            <span>Adicionar</span>
                        </button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>
