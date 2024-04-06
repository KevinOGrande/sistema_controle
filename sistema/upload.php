<?php
/* verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    /* variaveis que recebem as informações do formulario da pagina "pesquisa.php" ou "listar_empresa.php" */
    $mes= $_POST['mes'];
    $ano=$_POST['ano'];
    $cnpj = $_POST["cnpj"];
    $arquivo = $_FILES['pdf'];
    //variavel que recebe os caminho para a onde sera feito o upload
    $caminho = "C:/xampp/htdocs/estudo/sistema_controle/diretorio_empresa/".$cnpj."/Relatorio_".$mes."_".$ano.".pdf";
    //função que verifica se a função de upload de arquivo foi realizada com sucesso
    if(move_uploaded_file($arquivo['tmp_name'],$caminho)){
        header("location:listar_empresa.php?upload=true");
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}
?>