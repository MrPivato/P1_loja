 <!DOCTYPE html>
<html>
    <head>
        <title>IFRS BG</title>
        <?php include 'inc/site_skin.inc'; ?>
    </head>
    <body>

        <?php
        
            session_start();
        
			array_pop($_POST);
			
			foreach ($_POST as $key => $v) {
				$dif[] = $v;
			}
		
			array_pop($dif);
			
			var_dump($dif);
		
			$_SESSION['dif'] = $dif;
			$_SESSION['totalCompra'] = $_POST['totalCompra'];
		
			echo '<pre>';
            var_dump($_POST);
            echo '<hr>';
            var_dump($_SESSION);
            echo '<hr>';
			echo '</pre>';
            
            
        ?>
        
         <form method="POST" action="mail.php">
             <fieldset>
             
                <h2>Dados do Usuário</h2>
                Nome: <input type="text" name="nome" required><br>
                Email: <input type="email" name="email" required><br>
                Cidade: 
                <select name="cidade" required>
                
                    <option selected name="city" value="bento">Bento Gonçalves</option>
                    <option name="city" value="caxias">Caxias do Sul</option>
                    <option name="city" value="roma">Roma</option>
                
                </select><br>
                Endereço: <input type="text" name="endereco" required><br>
                CEP: <input type="number" name="cep" required><br>
                
                <hr>
                
                <h2>Dados do Pagamento</h2>
                
                Operadora:  <input type="radio" name="oper" value="visa" required>Visa
                            <input type="radio" name="oper" value="mastercard" required>Mastercard<br>
                
                Cartão: <input type="text" name="cartao" required><br>
                Código: <input type="number" name="number" required><br>
                
                <input type="submit" name="enviar" value="Finalizar"><br>
            </fieldset> 
        </form> 
        
    </body>
</html> 