<?php 
class ProdutoFactory {
    
    private $classes = array("Produto", "Ebook", "LivroFisico");

    public function criaPor($tipoProduto, $params) {
    
        //extraindo os valores 
        $nome = $params['nome'];
        $preco = $params['preco'];
        $descricao = $params['descricao'];
        $categoria = new Categoria();
        $usado = $params['usado'];

        //testando se o $tipoProduto existe no array $classes
        if (in_array($tipoProduto, $this->classes)) {
            //instanciando o objeto
            return new $tipoProduto($nome, $preco, $descricao, $categoria, $usado);
        }

        //se nao encontramos nada, vamos criar um produto: 
        return new Produto($nome, $preco, $descricao, $categoria, $usado);
    
    }
}