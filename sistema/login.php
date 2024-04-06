<?php
//inicio da sessão
session_start();
/* variaveis que recebem as informações do formulario da pagina "lista_arquivo.php" */
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$conexao = new PDO("mysql:host=localhost;dbname=sis_controle","kevin","1234");
if($conexao){
    //verificação de credenciais
    $requsicao_user = $conexao->query("SELECT adm, senha, nome FROM usuario WHERE adm='$usuario' and senha='$senha'");
    $requsicao_empresa = $conexao->query("SELECT cnpj FROM empresa WHERE usuario='$usuario' and senha='$senha'");
    $linha_usuario = $requsicao_user-> fetch(PDO::FETCH_ASSOC);
    $linha_empresa = $requsicao_empresa-> fetch(PDO::FETCH_ASSOC);
    if($linha_usuario){
        $_SESSION['login_senai'] = true;
        $_SESSION['nome_usuario'] = $linha_usuario['nome'];
        header("location:index.php");
        $conexao=null;
        exit();
    }else if($linha_empresa){
        $_SESSION['login_empresa'] = true;
        $_SESSION['cnpj']= $linha_empresa['cnpj'];
        header("location:index_empresa.php");
    }else{
        header("location:login_front.php?login=erro");
    }
    $conexao=null;
}