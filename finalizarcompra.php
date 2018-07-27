 <!DOCTYPE html>
<html>
    <head>
        <title>IFRS BG</title>
        <?php include 'inc/site_skin.inc'; ?>
    </head>
    <body>
	
		<header>
			<h1>Finalizar compras do IFRS.</h1>
		</header>

        <?php
        
            session_start();
        
			array_pop($_POST); // remove o valor "Finalizar"
			
			foreach ($_POST as $key => $v) { // add para a var $dif os diferenciais, 
				$dif[] = $v; // "Tamanho" e "Quantidade" de todos os produtos no carrinho
			}
		
			array_pop($dif); // remove o "preço total"
			
			//var_dump($dif);
		
			$_SESSION['dif'] = $dif; // add para a session, para poder ser usada depois
			$_SESSION['totalCompra'] = $_POST['totalCompra']; // add para a session o valor total da compra
		
		/*
			echo '<pre>';
            var_dump($_POST);
            echo '<hr>';
            var_dump($_SESSION);
            echo '<hr>';
			echo '</pre>';
        */
            
        ?>
        
         <form method="POST" action="mail.php">
             <fieldset>
             
                <h2>Dados do Usuário</h2>
                Nome: <input type="text" name="nome" required><br>
                Email: <input type="email" name="email" required><br>
                Cidade: 
                <select name="cidade" required>
                
                    <option selected name="city" value="Bento Gonçalves">Bento Gonçalves</option>
                    <option name="city" value="Caxias do Sul">Caxias do Sul</option>
                    <option name="city" value="Roma">Roma</option>
                
                </select><br>
                Endereço: <input type="text" name="endereco" required><br>
                CEP: <input type="number" name="cep" required><br>
                
                <hr>
                
                <h2>Dados do Pagamento</h2>
                
                Operadora:  <input type="radio" name="oper" value="Visa" required>Visa
                            <input type="radio" name="oper" value="Mastercard" required>Mastercard<br>
                
                Cartão: <input type="text" name="cartao" required><br>
                Código: <input type="number" name="number" required><br>
                
                <input type="submit" name="enviar" value="Finalizar"><br>
            </fieldset> 
        </form> 
        
    </body>
</html> 