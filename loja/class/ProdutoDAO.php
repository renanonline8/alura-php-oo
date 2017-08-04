<?php
class ProdutoDAO {
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    function listaProdutos() {

        $produtos = array();
        $resultado = mysqli_query($this->conexao, "select p.*,c.nome as categoria_nome from 
                produtos as p join categorias as c on c.id=p.categoria_id");

        while($produto_array = mysqli_fetch_assoc($resultado)) {
            $categoria = new Categoria();
            $categoria->setNome($produto_array['categoria_nome']);

            $nome = $produto_array['nome'];
            $descricao = $produto_array['descricao'];
            $preco = $produto_array['preco'];
            $usado = $produto_array['usado'];
            $isbn = $produto_array['isbn'];
            $tipoProduto = $produto_array['tipoProduto'];

            if ($tipoProduto == "Livro") {
                $produto = new Livro($nome, $preco, $descricao, $categoria, $usado);
                $produto->setISBN($isbn);
            } else {
                $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
            }
            
            $produto->setId($produto_array['id']);

            array_push($produtos, $produto);
        }

        return $produtos;
    }

    function insereProduto(Produto $produto) {

        $isbn = "";
        if ($produto->temIsbn()) {
            $isbn = $produto->getIsbn();
        }

        $tipoProduto = get_class($produto);

        $query = "insert into produtos (nome, preco, descricao, categoria_id, usado, tipoProduto, isbn) 
            values ('{$produto->getNome()}', {$produto->getPreco()}, '{$produto->getDescricao()}', 
                {$produto->getCategoria()->getNome()}, {$produto->getUsado()}), '{$tipoProduto}', '{$isbn}'";

        return mysqli_query($this->conexao, $query);
    }

    function alteraProduto(Produto $produto) {

        $isbn = "";
        if ($produto->temIsbn()) {
            $isbn = $produto->getIsbn();
        }

        $tipoProduto = get_class($produto);

        $query = "update produtos set nome = '{$produto->getNome()}', preco = {$produto->getPreco()}, 
            descricao = '{$produto->getDescricao()}', categoria_id= {$produto->getCategoria()->getNome()}, 
                usado = {$produto->getUsado()}, tipoProduto = '{$tipoProduto}', isbn = '{$isbn}' where id = '{$produto->getId()}'";

        return mysqli_query($this->conexao, $query);
    }

    function buscaProduto($id) {

        $query = "select * from produtos where id = {$id}";
        $resultado = mysqli_query($this->conexao, $query);
        $produto_array = mysqli_fetch_assoc($resultado);

        $nome = $produto_array['nome'];
        $preco = $produto_array['preco'];
        $descricao = $produto_array['descricao'];
        $usado = $produto_array['usado'];
        $isbn = $produto_array['isbn'];
        $tipoProduto = $produto_array['tipoProduto'];

        $categoria = new Categoria();
        $categoria->getId($produto_array['categoria_id']);

        if ($tipoProduto == "Livro") {
            $produto = new Livro($nome, $preco, $descricao, $categoria, $usado);
            $produto->setISBN($isbn);
        } else {
            $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
        }
        $produto->getId($produto_array['id']);

        return $produto;
    }

    function removeProduto($id) {

        $query = "delete from produtos where id = {$id}";

        return mysqli_query($this->conexao, $query);
    }
}