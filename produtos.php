<!DOCTYPE html>
<html>
	<head>
		<title>IFRS BG</title>
		<?php include_once 'inc/site_skin.inc'; ?>
		<meta charset="utf-8">
	</head>
	<body>

		<header>
			<!-- Dps fazer com include -->
			<h1>Site de compras do IFRS.</h1>
			<div class="menu">

				<a href="carrinho.php">Ver Carrinho</a>
				<strong>&nbsp;|&nbsp;</strong>
				<a href="#">Autor</a>

			</div>
		</header>

		<br clear="all">

		<section>
			
			<div class="produtos">
			
					<table border="0">
					<?php
						$arquivo = fopen('produtos.txt', 'r'); // abre para leitura
						
						while (!feof($arquivo)) {// Le oque esta dentro do arquivo 
							
							$linha = fgets($arquivo, 1024);//Mostra uma linha do arquivo
							
							$produto = explode("|", $linha);//separa os conteúdos desta linha (pelo caractere |) e coloca em um vetor
							//mostra o produto na tela
							echo "
									<tr>
										<td>
											<figure>
												<img name='imagem' src='{$produto[1]}' >
												<figcaption name='produto'>{$produto[2]}</figcaption>
											</figure>
										</td>
										<td><p>{$produto[3]}</p></td>
										<td><p>{$produto[4]}</p></td>
										<td></p><a href='addCarrinho.php?id={$produto[0]}'>Comprar</a></td>
									</tr>
							";
						}
						// Fecha arquivo aberto
						fclose($arquivo);
					?>                   
					</table>

			</div>

		</section>

	</body>
</html> 