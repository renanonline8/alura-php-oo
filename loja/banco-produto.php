<?php
require_once("conecta.php");
require_once("class/Produto.php");
require_once("class/Categoria.php");

function listaProdutos($conexao) {

	$produtos = array();
	$resultado = mysqli_query($conexao, "select p.*,c.nome as categoria_nome from 
			produtos as p join categorias as c on c.id=p.categoria_id");

	while($produto_array = mysqli_fetch_assoc($resultado)) {
		$categoria = new Categoria();
		$categoria->setNome($produto_array['categoria_nome']);

		$produto = new Produto();
		$produto->setId($produto_array['id']);
		$produto->setNome($produto_array['nome']);
		$produto->setDescricao($produto_array['descricao']);
		$produto->setCategoria($categoria);
		$produto->setPreco($produto_array['preco']);
		$produto->setUsado($produto_array['usado']);

		array_push($produtos, $produto);
	}

	return $produtos;
}

function insereProduto($conexao, Produto $produto) {

	$query = "insert into produtos (nome, preco, descricao, categoria_id, usado) 
		values ('{$produto->getNome()}', {$produto->getPreco()}, '{$produto->getDescricao()}', {$produto->getCategoria()->getNome()}, {$produto->getUsado()})";

	return mysqli_query($conexao, $query);
}

function alteraProduto($conexao, Produto $produto) {

	$query = "update produtos set nome = '{$produto->getNome()}', preco = {$produto->getPreco()}, 
		descricao = '{$produto->getDescricao()}', categoria_id= {$produto->getCategoria()->getNome()}, 
			usado = {$produto->getUsado()} where id = '{$produto->getId()}'";

	return mysqli_query($conexao, $query);
}

function buscaProduto($conexao, $id) {

	$query = "select * from produtos where id = {$id}";
	$resultado = mysqli_query($conexao, $query);
	$produto_array = mysqli_fetch_assoc($resultado);

	$nome = $produto_array['nome'];
	$preco = $produto_array['preco'];
	$descricao = $produto_array['descricao'];
	$usado = $produto_array['usado'];

	$categoria = new Categoria();
	$categoria->getId($produto_array['categoria_id']);

	$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
	$produto->getId($produto_array['id']);

	return $produto;
}

function removeProduto($conexao, $id) {

	$query = "delete from produtos where id = {$id}";

	return mysqli_query($conexao, $query);
}