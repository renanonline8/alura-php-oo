<?php
class Livro extends Produto {
    private $isbn;

    function getISBN(){
        return $this->$isbn;
    }

    function setISBN($valor){
        $this->$isbn = $valor;
    }
}