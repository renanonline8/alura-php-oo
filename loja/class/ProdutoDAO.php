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

            $tipoProduto = $_POST['tipoProduto'];
            $categoria_id = $_POST['categoria_id'];

            $factory = new ProdutoFactory();
            $produto = $factory->criaPor($tipoProduto, $_POST);
            $produto->atualizaBaseadoEm($_POST);

            $produto->getCategoria()->setId($categoria_id);
            $produto->setId($produto_array['id']);

            if(array_key_exists('usado', $_POST)) {
                $produto->setUsado("true");
            } else {
                $produto->setUsado("false");
            }
            
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

        $query = "insert into produtos (nome, preco, descricao, categoria_id, usado, tipoProduto, isbn, waterMark, taxaImpressao) 
            values ('{$produto->getNome()}', {$produto->getPreco()}, '{$produto->getDescricao()}', 
                {$produto->getCategoria()->getNome()}, {$produto->getUsado()}), '{$tipoProduto}', '{$isbn}', '{$produto->getWaterMark()}', 
                    '{$produto->getTaxaImpressao()}'";

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
                usado = {$produto->getUsado()}, tipoProduto = '{$tipoProduto}', isbn = '{$isbn}', watermark = '{$produto->getWaterMark()'}, 
                    taxaImpressao = '{$produto->getTaxaImpressao()}' where id = '{$produto->getId()}'";

        return mysqli_query($this->conexao, $query);
    }

    function buscaProduto($id) {

        $query = "select * from produtos where id = {$id}";
        $resultado = mysqli_query($this->conexao, $query);
        $produto_array = mysqli_fetch_assoc($resultado);

        $tipoProduto = $_POST['tipoProduto'];
        $categoria_id = $_POST['categoria_id'];

        $factory = new ProdutoFactory();
        $produto = $factory->criaPor($tipoProduto, $_POST);
        $produto->atualizaBaseadoEm($_POST);

        $produto->getCategoria()->setId($categoria_id);
        $produto->setId($produto_array['id']);

        if(array_key_exists('usado', $_POST)) {
            $produto->setUsado("true");
        } else {
            $produto->setUsado("false");
        }

        return $produto;
    }

    function removeProduto($id) {

        $query = "delete from produtos where id = {$id}";

        return mysqli_query($this->conexao, $query);
    }
}