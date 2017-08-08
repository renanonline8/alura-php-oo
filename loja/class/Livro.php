<?php
abstract class Livro extends Produto {
    private $isbn;

    function getISBN(){
        return $this->$isbn;
    }

    function setISBN($valor){
        $this->$isbn = $valor;
    }

    function calculaImposto() {
        return $this->getPreco * 0,065;
    }
}