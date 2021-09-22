
	<table id="rounded-corner" summary="">
		<thead>
			<tr>
				<th scope="col" class="rounded-company">Titulo</th>
				<th scope="col" class="rounded">Quitar</th>
				<th scope="col" class="rounded-q4">Orden</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($noticias as $key => $value): ?>
				<tr>
					<td scope="col" class="rounded"><?php echo $noticias[$key]["titulo"]; ?></td>
					<td>
						<a class="ask" href="?del=<?php echo $noticias[$key]["id_noticia_tapa"] ?>&col=3&id_categoria=<?php echo $idCategoria; ?>"><img src="images/trash.png" alt="" title="" border="0" /></a>
					</td>
					<td>
						<form method="GET" action="noticias_en_tapa.php">
						<input name="id_categoria" type="hidden" value="<?php echo $idCategoria; ?>" />
						<input name="col" type="hidden" value="0" />
						<input name="oid" type="hidden" value="<?php echo $noticias[$key]["id_noticia_tapa"] ?>" />
						<select name="orden" onchange="this.form.submit();">
						<?php for($num=1;$num<sizeof($noticias)+1;$num++): ?>
							<option <?php echo ($num==$key+1) ? 'selected="selected"' : ""; ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
						<?php endfor ?>
						</select>
						</form>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
