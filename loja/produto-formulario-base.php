<tr>
	<td>Nome</td>
	<td>
		<input class="form-control" type="text" name="nome" 
			value="<?=$produto->getNome()?>">
	</td>
</tr>
<tr>
	<td>Preço</td>
	<td>
		<input class="form-control" type="number" step="0.01" name="preco" 
			value="<?=$produto->getPreco()?>">
	</td>
</tr>
<tr>
	<td>Descrição</td>
	<td>
		<textarea class="form-control" name="descricao"><?=$produto->getDescricao()?></textarea>
	</td>
</tr>
<tr>
	<td></td>
	<td><input type="checkbox" name="usado" <?=$produto->getUsado()?> value="true"> Usado
</tr>
<tr>
	<td>Categoria</td>
	<td>
		<select name="categoria_id" class="form-control">
			<?php
			foreach($categorias as $categoria) : 
				$essaEhACategoria = $produto->getCategoria()->getID() == $categoria->getID();
				$selecao = $essaEhACategoria ? "selected='selected'" : "";
			?>
				<option value="<?=$categoria->getID()?>" <?=$selecao?>>
					<?=$categoria->getNome()?>
				</option>
			<?php 
			endforeach
			?>
		</select>
	</td>
</tr>
<tr>
    <td>Tipo do produto</td>
    <td>
        <select name="tipoProduto" class="form-control">
            <?php
            $tipos = array("Ebook", "Livro Fisico");
            foreach($tipos as $tipo) : 
				$tipoSemEspaco = str_replace(' ', '', $tipo)
                $esseEhOTipo = get_class($produto) == $tipo;
                $selecaoTipo = $esseEhOTipo ? "selected='selected'" : "";
            ?>
				<?php if ($tipo == "Ebook") : ?>
					<optgroup label="Livros">
				<?php endif ?>
                <option value="<?=$tipo?>" <?=$selecaoTipo?>>
                    <?=$tipo?>
                </option>
				<?php if ($tipo == "Livro Fisico") : ?>
					</optgroup>
				<?php endif ?>
				<?php
            <?php
            endforeach 
            ?>
        </select>
    </td>
</tr>
<tr>
    <td>ISBN (caso seja um Livro)</td>
    <td>
        <input type="text" name="isbn" class="form-control" 
            value="<?php if ($produto->temIsbn()) { echo $produto->getIsbn(); } ?>" >
    </td>
</tr>
<tr>
    <td>Taxa de impressão</td>
    <td>
        <input type="text" name="taxaImpressao" class="form-control" 
            value="<?php if ($produto->temTaxaImpressao()) { echo $produto->getTaxaImpressao(); } ?>" >
    </td>
</tr>
<tr>
    <td>WaterMark</td>
    <td>
        <input type="text" name="waterMark" class="form-control" 
            value="<?php if ($produto->temWaterMark()) { echo $produto->getWaterMark(); } ?>" >
    </td>
</tr>