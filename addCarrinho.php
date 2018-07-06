<?php

//Inicia a sessão
session_start();

//verifica se o carrinho de compras está vazio
if (empty($_SESSION['carrinho'])) {
    //cria um carrinho de compras vazio
    $_SESSION['carrinho'] = [];
}
//$_SESSION['carrinho']="";
//Referencia a Session para uma variável
$carrinho = $_SESSION['carrinho'];

//verifica se foi passado algum id de produto pela URL
if (!empty($_GET['id'])) {
    $id = $_GET["id"];
    $existe = false;
    //Percorro o array de produtos que está no carrinho de compras
    foreach ($carrinho as $produto) {
        //Vejo os detalhes de cada produto no carrinho
        if ($produto["id"] == $id) {
            $existe = true;
            break;
        }
    }
    if ($existe == false) {
        // Abre o Arquivo no Modo r (para leitura)
        // para buscar as outras informações
        $arquivo = fopen('produtos.txt', 'r');
        // Lê o conteúdo do arquivo 
        while (!feof($arquivo)) {
            //Mostra uma linha do arquivo
            $linha = fgets($arquivo, 1024);
            //separa os conteúdos desta linha (pelo caractere |) e coloca em um vetor
            $produto = explode("|", $linha);
            //Se encontra o id do produto dentro do arquivo
            if ($produto[0] == $id) {
                //Adiciona o produto no carrinho de compras        
                $produto = array("id" => $id, "nome" => $produto[2], "descricao" => $produto[3], "preco" => floatval($produto[4]), "imagem" => $produto[1], "tamanho" => "", "quantidade" => 1, "subtotal" => floatval($produto[4]));
                array_push($carrinho, $produto);
                break;
            }
        }
    }
} else {
    echo "<script>alert('Lamento, mas houve um erro ao adicionar um produto no carrinho de compras!');</script>";
}

$_SESSION['carrinho'] = $carrinho;

var_dump($_SESSION['carrinho']);

?>
<a href="produtos.php">Voltar aos produtos.</a>
