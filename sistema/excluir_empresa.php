<?php
/* verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    /* variavel que faz a conexão ao banco de dados com o metodo PDO */
    $conexao= new PDO("mysql:host=localhost;dbname=sis_controle","kevin","1234");
    if($conexao){
        /* variaveis que recebem as informações do formulario da pagina "permissão_excluir.php" */
        $cnpj= $_POST['cnpj'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $nome = $_SESSION['nome_usuario'];
        /* Variavel que recebe  resultado de uma query SQL na forma de array que verifica a permissão para excluir a empresa*/
        $permissao = $conexao->query("SELECT adm FROM usuario WHERE adm='$usuario' and senha='$senha' and nome='$nome'");
        /* Variavel que recebe a primeria linha do array do resultado da query SQL*/
        $linha = $permissao-> fetch(PDO::FETCH_ASSOC);
        //verficação se a consulta for verdadeira
        if($linha){
            //Query para excluir os dados da empresa do banco de dados
            $conexao-> query("DELETE FROM empresa WHERE cnpj='$cnpj'");
            //variavel que recebe um objeto que contem todas as informações do diretorio que contem os arquivos
            $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle/diretorio_empresa/".$cnpj);
            //laço de repetição que percorre o objeto atribuido as informações de cada arquivo a cada repetição a variavel $nome_arquivo
            while(($nome_arquivo = $arquivo->read())!== false){
                if($nome_arquivo!=="." && $nome_arquivo!==".."){
                    //função para excluir arquivo
                    unlink("C:/xampp/htdocs/estudo/sistema_controle/diretorio_empresa/".$cnpj."/".$nome_arquivo);
                }   
            }
            //verificação se a função de excluir diretorio foi realizada com sucesso
            if(rmdir("C:/xampp/htdocs/estudo/sistema_controle/diretorio_empresa/".$cnpj)){
                header("location:index.php?excluir_empresa=true");
            }
            $conexao=NULL;
        }else{
            header("location:index.php?erro_comfirmacao=true");
        }
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}