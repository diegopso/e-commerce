<select id="select-categoria-pai" name="id_categoria_pai" data-placeholder="<?= $mensagem_padrao ?>">
	<option value="0"><?= $mensagem_padrao ?></option>
	<?php foreach ($categorias as $categoria): ?>
	<option value="<?= $categoria->id ?>"><?= $categoria->nome ?></option>
	<?php endforeach; ?>
</select>