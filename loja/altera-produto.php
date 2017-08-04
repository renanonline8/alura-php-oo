<?php
require_once("cabecalho.php");
require_once("banco-produto.php");
require_once("class/Produto.php");
require_once("class/Categoria.php");

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];
$tipoProduto = $_POST['tipoProduto'];
$isbn = $_POST['isbn'];

if(array_key_exists('usado', $_POST)) {
	$usado = "true";
} else {
	$usado = "false";
}

$categoria = new Categoria();
$categoria->setId($_POST['categoria_id']);

if ($tipoProduto == "Livro") {
	$produto = new Livro($nome, $preco, $descricao, $categoria, $usado);
	$produto = setIsbn($isbn);
} else {
	$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
}

$produto->setId($_POST['id']);

$produtoDAO = new ProdutoDAO($conexao);
if($produtoDAO->alteraProduto($produto)) { ?>
	<p class="text-success">O produto <?= $produto->getNome() ?>, <?= $produto->getPreco() ?> foi alterado.</p>
<?php 
} else {
	$msg = mysqli_error($conexao);
?>
	<p class="text-danger">O produto <?= $produto->getNome() ?> não foi alterado: <?= $msg?></p>
<?php
}
?>

<?php include("rodape.php"); ?>