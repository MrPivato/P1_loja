<!DOCTYPE html>
<html>
	<head>
		<title>IFRS BG</title>
		<?php include_once 'inc/site_skin.inc'; ?>
	</head>
	<body>

		<header>
			<!-- Dps fazer com include -->
			<h1>Carrinho de compras do IFRS.</h1>
			<div class="menu">

				<a href="produtos.php">Voltar ao site</a>
				
			</div>
		</header>

		<br clear="all">

		<form method="POST" action="finalizarcompra.php">
			<table border="0">
                <?php

                    //Inicia a sessão
                    session_start();

                    //verifica se o carrinho de compras está vazio
                    if (empty($_SESSION['carrinho'])) {
                        //cria um carrinho de compras vazio
                        $_SESSION['carrinho'] = [];
                    }else{
                        
                        // Abre o Arquivo no Modo r (para leitura)
                        $arquivo = fopen('produtos.txt', 'r');
                        // Lê o conteúdo do arquivo 
                        while (!feof($arquivo)) {
                            //Mostra uma linha do arquivo
                            $linha = fgets($arquivo, 1024);
                            //separa os conteúdos desta linha (pelo caractere |) e coloca em um vetor
                            $produto = explode("|", $linha);
                            //Verifica pelo id se o produto já está no carrinho de compras
                            if (!in_array($produto[0], $_SESSION['carrinho'])) {
                                //Adiciona o produto com toda sua descrição no carrinho de compras
                            }

                        }
                        // Fecha arquivo aberto
                        fclose($arquivo);
                    }
					
					$c = 0;
					
					foreach ($_SESSION['carrinho'] as $key => $value) {
// array("id" => $id, "nome" => $produto[2], "descricao" => $produto[3], "preco" => floatval($produto[4]), "imagem" => $produto[1], "tamanho" => "", "quantidade" => 1, "subtotal" => floatval($produto[4]));
						echo "
								<tr>
									<td>
										<figure>
											<img name='imagem' src='{$value['imagem']}' >
											<figcaption name='produto'>{$value['nome']}</figcaption>
										</figure>
									</td>
									<td><p>{$value['descricao']}</p></td>
									<td><p>Preço: {$value['preco']} Reais</p></td>
									<td>
										Tamanho: <select>
											<option value='pp'>PP</option>
											<option value='p'>P</option>
											<option value='m'>M</option>
											<option value='g'>G</option>
											<option value='gg'>GG</option>
										</select><br>
											
										Quantidade: <input type='number' id='a{$c}' onchange='calcula(e)' value='1'  min='1'></input>
									</td>
								</tr>
						";
						
						$c++;
						
					}
					$precoTotala = 0;
					$precoTotal = 0;
					
					foreach ($_SESSION['carrinho'] as $key => $value) {
						$precoTotala += $value['preco'];
					}
					
					foreach ($_SESSION['carrinho'] as $key => $value) {
						$precoTotal += $value['subtotal'];
					}

                    echo"<pre>";
						var_dump($_SESSION['carrinho']);    
                    echo"</pre>";
                ?>
			</table>
			
            <input type="submit" value="Finalizar Compra" name="submit">
			
            </form>
			<script>
			
				//document.getElementById('inc').value = ++precoFinal;
				
				function calcula(e){
					var caller = e.target || e.srcElement;
					console.log( caller );
				}
				
				var precoFinala = <?php echo json_encode($precoTotala); ?>;
				document.write("<h1>Preço Total é: ", precoFinala, " Reais</h1>");
				
				var precoFinal = <?php echo json_encode($precoTotal); ?>;
				document.write("<h1>Preço Total é: ", precoFinal, " Reais</h1>");
			</script>
			<script>
				document.getElementById("fname").addEventListener("change", myFunction);

				function myFunction() {
					var x = document.getElementById("fname");
					x.value = x.value.toUpperCase();
				}
			</script>
			
	</body>
</html> 