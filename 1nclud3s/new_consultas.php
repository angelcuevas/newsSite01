<?php
$fotos  = $db->query(" SELECT noticias_fotos.url,  noticias_fotos.id_noticia  FROM noticias_fotos  INNER JOIN noticias_tapa ON noticias_tapa.id_noticia = noticias_fotos.id_noticia ");

$audios = $db->query(" SELECT noticias_audios.url, noticias_audios.id_noticia FROM noticias_audios INNER JOIN noticias_tapa ON noticias_tapa.id_noticia = noticias_audios.id_noticia");

$videos = $db->query(" SELECT noticias_videos.url, noticias_videos.id_noticia FROM noticias_videos INNER JOIN noticias_tapa ON noticias_tapa.id_noticia = noticias_videos.id_noticia");

$noticiasTapa = $db->query("SELECT noticias.hits,noticias.id_categoria,	noticias_tapa.columna,	noticias.id_noticia, noticias.volanta,	noticias.copete,	noticias.titulo,	noticias.fecha,	noticias.activa, noticias_categorias.nombre	FROM noticias_tapa INNER JOIN noticias ON  noticias_tapa.Id_Noticia = noticias.id_Noticia LEFT JOIN noticias_categorias ON noticias_categorias.id_categoria = noticias.id_categoria ORDER BY noticias_tapa.ubicacion ASC");

$categorias = $db->query("SELECT id_categoria, nombre, ubicacion FROM noticias_categorias");

$lastPost = $db->query("SELECT noticias.id_noticia, noticias.titulo, (SELECT noticias_fotos.url FROM noticias_fotos WHERE noticias_fotos.id_noticia = noticias.id_noticia LIMIT 1 ) as foto FROM noticias WHERE DAY(NOW())-30 < DAY(noticias.fecha) ORDER BY fecha DESC LIMIT 5");
?>