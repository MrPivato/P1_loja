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

		<form method="POST" action="finalizarcompra.php" name="comprar">
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
					
					$c = 1;
					
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
										Tamanho: <select name='select{$c}'>
											<option value='pp'>PP</option>
											<option value='p'>P</option>
											<option value='m'>M</option>
											<option value='g'>G</option>
											<option value='gg'>GG</option>
										</select><br>
										Quantidade: <input name='quant{$c}' id='{$c}' type='number' onchange='calcula({$value['preco']}, this.id, this.value)' value='1'  min='1' step='1'>	
									</td>
								</tr>
						";
						
						$c++;
						
					}

					$precoTotal = 0;
					
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
		
		<div>
			<b>Preço total: </b>
			<b id="total"><?php echo $precoTotal; ?></b>
			<b>Reais</b>
		</div>
		
			<script>
			
				var subtotal = 0; //var com o subtotal de um produto
				var totalVet = new Array(); // vetor como subtotal de todos produtos do carrinho, com a quantia modificada
				
				var totalPhp = <?php echo json_encode($precoTotal); ?>;
				
				totalVet[0] = totalPhp;
				
				function calcula(preco, id, quantia){
					
					parseFloat(preco);
					parseInt(quantia);
					
					if (quantia == 1){
						subtotal = 0;
					} else{
						subtotal = preco * quantia;
					}
					
					totalVet[id] = subtotal;
					
					console.log(preco, id);
					
					dindin(subtotal);
				}
				
				function dindin(total){
					
					var soma = 0;
					for(var i in totalVet) { soma += totalVet[i]; }
					
					document.getElementById('total').innerHTML = soma;
				}
				
				
			</script>
			
	</body>
</html> 