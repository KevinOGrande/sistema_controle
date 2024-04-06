<?php
/* variaveis que recebem as informações do formulario da pagina "lista_arquivo.php" */
$diretorio=$_POST['diretorio'];
$arquivo=$_POST['arquivo'];
//Veficação se a função de excluir arquivo foi executada com sucesso
if(unlink("C:/xampp/htdocs/estudo/sistema_controle/diretorio_empresa/".$diretorio."/".$arquivo)){
    header("location:listar_empresa.php?arquivo_excluido=true");
}else{
    header("location:listar_empresa.php?arquivo_excluido=false");
}
?>