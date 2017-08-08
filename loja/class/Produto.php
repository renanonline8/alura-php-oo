<?php
abstract class Produto {
    
    private $id;
    private $nome;
    private $preco;
    private $descricao;
    private $categoria;
    private $usado;

    function __construct($nome, $preco, $descricao, Categoria $categoria, $usado) {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
        $this->categoria = $categoria;
        $this->usado = $usado;
    }

    function __toString(){
        return $this->nome .": R$ ".$this->preco;
    }



    public function precoComDesconto($desconto = 0.1) {
        if ($desconto >= 0 && $desconto < 0.5) {
            $this->preco -= ($this->preco * $desconto);
        }
        return $this->preco;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getUsado() {
        return $this->usado;
    }

    public function setUsado($usado) {
        $this->usado = $usado;
    }

    public function temIsbn() {
        return $this instanceof Livro;
    }

    public function temWaterMark() {
        return $this instanceof Ebook;
    }

    public function temTaxaImpresao() {
        return $this instanceof LivroFisico;
    }

    public function calculaImposto() {
        return $this->preco * 0.195;
    }

    abstract function atualizaBaseadoEm($params);
    
}