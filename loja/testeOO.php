<?php

    require "class/Produto.php";

    $produto = new Produto();
    $produto->setPreco(30.5);
    $produto->setNome("Livro da Casa do Codigo");

    $outroProduto = $produto;
    $outroProduto->setPreco(59.9);
    $outroProduto->setNome("Livro da Casa do Codigo");

    if ($produto === $outroProduto) {
        echo "sao iguais";
    } else {
        echo "sao diferentes";
    }

?>