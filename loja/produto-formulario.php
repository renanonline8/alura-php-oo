<?php
require_once("cabecalho.php");
require_once("banco-categoria.php");
require_once("logica-usuario.php");
require_once("class/Produto.php");
require_once("class/Categoria.php");

verificaUsuario();

$produto = new Produto();
$produto->nome = "";
$produto->descricao = "";
$produto->preco = "";
$produto->usado = "";

$categoria = new Categoria();
$categoria->id = "1";
$produto->categoria = $categoria;

/*
2017-08-02 Antes de orientar a objeto
$produto = array("nome" => "", "descricao" => "", "preco" => "", 
	"categoria_id" => "1", "usado" => "");*/

$categorias = listaCategorias($conexao);

?>	

<h1>Formulário de produto</h1>
<form action="adiciona-produto.php" method="post">
	<table class="table">
		
		<?php include("produto-formulario-base.php"); ?>

		<tr>
			<td>
				<button class="btn btn-primary" type="submit">Cadastrar</button>
			</td>
		</tr>
	</table>
</form>

<?php include("rodape.php"); ?>