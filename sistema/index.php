<?php
/* Inicio e verificação de sessão */
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:wght@100&display=swap" rel="stylesheet">
        <title>Menu</title>
        <!-- Detalhes de estilização e posicionamento -->
        <style>
            header{
                background-color: #1B62B7;
            }
            .texto_botao{
                text-decoration: none;
                color: whitesmoke;
            }
            .botoes{
                margin-top:17%;
            }
            .fs-1{
                margin-left:39%;
                margin-top:5%;
            }
            .botoes{
                margin-top:10%;
            }
            .botao_adicionar{
                margin-left:57%;
            }
            .barra{
                display:flex;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <div class="container-fluid">
                    <img src="image/senai_logo1.png" alt="">
                    <a href="login_front.php" onclick = "return confirm('Desejar sair?')" class="btn btn-secondary">Sair</a>
                    <div class="botao_adicionar"><a href="cad_user_senai.php" class="btn btn-info">Adicionar usuario</a></div>
                    <form class="d-flex" role="search" action="pesquisa.php" method="post">
                        <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" name="pesquisa">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </header>
        <div>
            <!-- Notificações em javascript apartir de um parametro de uma super global GET -->
            <?php
                if(isset($_GET['cad']) && $_GET['cad'] == 'existente'){
                ?>
                <!-- Caso a condição seja verdadeira, ira ser criado uma div e após três segundo sera excluido -->
                    <script>
                        var teste = document.createElement('div');
                        teste.textContent="Cadastro existente!";
                        teste.style.backgroundColor = "#FF0000";
                        teste.style.border = "2px solid"
                        teste.style.borderRadius = "7px";
                        teste.style.borderColor= "#B22222";
                        teste.style.width = "200px";
                        teste.style.height = "45px";
                        teste.style.marginLeft ="80%";
                        teste.style.marginTop ="-20%";
                        document.body.appendChild(teste);
                        setTimeout(function(){
                            document.body.removeChild(teste);
                            var novaurl = window.location.href.replace("?cad=existente","");
                            window.location.href = novaurl;
                        },2000);
                    </script>
                <?php
                }else if(isset($_GET['cad']) && $_GET['cad'] == 'cadastrado'){
                    ?>
                        <script>
                            var teste = document.createElement('div');
                            teste.textContent="Cadastro realizado com susseso!";
                            teste.style.backgroundColor = "#008000";
                            teste.style.border = "2px solid"
                            teste.style.borderRadius = "7px";
                            teste.style.borderColor= "#006400";
                            teste.style.width = "200px";
                            teste.style.height = "45px";
                            teste.style.marginLeft ="80%";
                            teste.style.marginTop ="-20%";
                            document.body.appendChild(teste);
                            setTimeout(function(){
                                document.body.removeChild(teste);
                                var novaurl = window.location.href.replace("?cad=cadastrado","");
                                window.location.href = novaurl;
                            },2000);
                            
                        </script>
                    <?php
                }
                if(isset($_GET['atualiza']) && $_GET['atualiza'] == true){
                        ?>
                            <script>
                                var teste = document.createElement('div');
                                teste.textContent="Atualização realizada com sucesso!";
                                teste.style.backgroundColor = "#008000";
                                teste.style.border = "2px solid"
                                teste.style.borderRadius = "7px";
                                teste.style.borderColor= "#006400";
                                teste.style.width = "200px";
                                teste.style.height = "45px";
                                teste.style.marginLeft ="80%";
                                teste.style.marginTop ="-20%";
                                document.body.appendChild(teste);
                                setTimeout(function(){
                                    document.body.removeChild(teste);
                                    var novaurl = window.location.href.replace("?atualiza=true","");
                                    window.location.href = novaurl;
                                },2000);
                            </script>
                        <?php
                }
                if(isset($_GET['atualiza']) && $_GET['atualiza'] == false){
                    ?>
                        <script>
                            var teste = document.createElement('div');
                            teste.textContent="Erro ao Atualizar! Tente novamente.";
                            teste.style.backgroundColor = "#FF0000";
                            teste.style.border = "2px solid"
                            teste.style.borderRadius = "7px";
                            teste.style.borderColor= "#B22222";
                            teste.style.width = "200px";
                            teste.style.height = "45px";
                            teste.style.marginLeft ="80%";
                            teste.style.marginTop ="-20%";
                            document.body.appendChild(teste);
                            setTimeout(function(){
                                document.body.removeChild(teste);
                                var novaurl = window.location.href.replace("?atualiza=false","");
                                window.location.href = novaurl;
                            },2000);
                        </script>
                    <?php
                }
                if(isset($_GET['erro_pesquisa']) && $_GET['erro_pesquisa'] == true){
                    ?>
                        <script>
                            var teste = document.createElement('div');
                            teste.textContent="Usuario não encontrado!";
                            teste.style.backgroundColor = "#FF0000";
                            teste.style.border = "2px solid";
                            teste.style.borderRadius = "7px";
                            teste.style.borderColor= "#B22222";
                            teste.style.width = "200px";
                            teste.style.height = "45px";
                            teste.style.marginLeft ="80%";
                            teste.style.marginTop ="-20%";
                            document.body.appendChild(teste);
                            setTimeout(function(){
                                document.body.removeChild(teste);
                                var novaurl = window.location.href.replace("?erro_pesquisa=true","");
                                window.location.href = novaurl;
                            },2000);
                        </script>
                    <?php
                }
                if(isset($_GET['excluir_empresa']) && $_GET['excluir_empresa'] == true){
                    ?>
                        <script>
                            var teste = document.createElement('div');
                            teste.textContent="Empresa excluida!";
                            teste.style.backgroundColor = "#008000";
                            teste.style.border = "2px solid"
                            teste.style.borderRadius = "7px";
                            teste.style.borderColor= "#006400";
                            teste.style.width = "200px";
                            teste.style.height = "45px";
                            teste.style.marginLeft ="80%";
                            teste.style.marginTop ="-20%";
                            document.body.appendChild(teste);
                            setTimeout(function(){
                                document.body.removeChild(teste);
                                var novaurl = window.location.href.replace("?excluir_empresa=true","");
                                window.location.href = novaurl;
                            },2000);
                        </script>
                    <?php
                }
                if(isset($_GET['erro_comfirmacao']) && $_GET['erro_comfirmacao'] == true){
                            ?>
                    <script>
                        var teste = document.createElement('div');
                        teste.textContent="Usuario ou Senha incorreto!";
                        teste.style.backgroundColor = "#FF0000";
                        teste.style.border = "2px solid"
                        teste.style.borderRadius = "7px";
                        teste.style.borderColor= "#B22222";
                        teste.style.width = "200px";
                        teste.style.height = "45px";
                        teste.style.marginLeft ="80%";
                        teste.style.marginTop ="-20%";
                        document.body.appendChild(teste);
                        setTimeout(function(){
                            document.body.removeChild(teste);
                            var novaurl = window.location.href.replace("?erro_comfirmacao=true","");
                            window.location.href = novaurl;
                        },2000);
                    </script>
                <?php
                }
                if(isset($_GET['cad_senai']) && $_GET['cad_senai'] == true){
                    ?>
                    <script>
                        var teste = document.createElement('div');
                        teste.textContent="Usuario senai cadastrado!";
                        teste.style.backgroundColor = "#008000";
                        teste.style.border = "2px solid"
                        teste.style.borderRadius = "7px";
                        teste.style.borderColor= "#006400";
                        teste.style.width = "200px";
                        teste.style.height = "45px";
                        teste.style.marginLeft ="80%";
                        teste.style.marginTop ="-20%";
                        document.body.appendChild(teste);
                        setTimeout(function(){
                            document.body.removeChild(teste);
                            var novaurl = window.location.href.replace("?cad_senai=true","");
                            window.location.href = novaurl;
                        },2000);
                    </script>
                <?php
                }else if(isset($_GET['cad_senai']) && $_GET['cad_senai'] == false){
                    ?>
                        <script>
                            var teste = document.createElement('div');
                            teste.textContent="Erro ao cadastrar usuario!";
                            teste.style.backgroundColor = "#FF0000";
                            teste.style.border = "2px solid"
                            teste.style.borderRadius = "7px";
                            teste.style.borderColor= "#B22222";
                            teste.style.width = "200px";
                            teste.style.height = "45px";
                            teste.style.marginLeft ="80%";
                            teste.style.marginTop ="-20%";
                            document.body.appendChild(teste);
                            setTimeout(function(){
                                document.body.removeChild(teste);
                                var novaurl = window.location.href.replace("?cad=false","");
                                window.location.href = novaurl;
                            },2000);
                            
                        </script>
                    <?php
                }
             ?>
            <p class="fs-1">Seja Bem-vindo <?php echo $_SESSION['nome_usuario'];?>!</p>
            <div class="botoes">
                <!-- links em forma de botão para o acesso ao cadastro de empresa e a listagem de empresa -->
                <div class="d-grid gap-2 col-3 mx-auto">
                    <div class="btn btn-primary"><a href="cadastro_empresa.php" class="texto_botao">Cadastrar Empresa</a></div>
                    <div class="btn btn-primary"><a href="listar_empresa.php" class="texto_botao">Listar Usuario</a></div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login_front.php");
}
?>