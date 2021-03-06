<?php
require_once '../../Controller/FichaExercicio/CrudFichaExercicio.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css vizualizarFicha/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Allerta+Stencil&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Andika&display=swap" rel="stylesheet">

    <title>PoriGYM</title>

</head>
<?php
$fichaexercicio = new CrudFichaExercicio;
if (isset($_POST['alterar'])) {
    $fichaexercicioAlterar = new CrudFichaExercicio;
    $fichaexercicioAlterar->setNum_serie($_POST['num_serie']);
    $fichaexercicioAlterar->setRepeticoes($_POST['repeticoes']);
    $fichaexercicioAlterar->setCarga($_POST['carga']);
    $fichaexercicioAlterar->setTempo_descanso($_POST['descanso']);
    $fichaexercicioAlterar->update($_POST['id_ficha']);
}


?>

<body>

    <main id="scrollbar">

        <div class="sequencia_topo">

            <p> Home </p>
            <p> > </p>
            <p>Treino</p>
            <p> > </p>
            <p>Listar Treinos</p>
            <p> > </p>
            <p>Listar Fichas</p>
            <p> > </p>
            <p>Listar Exercícios</p>

        </div>

        <div class="container_main">

            <div class="conteudo">
                <h1 class="edit-title">Lista de Exercícios</h1>
                <h3 class="edit-title"><?php echo $_POST['nome_ficha'] ?></h3>
                <table class="table" border="1">
                    <thead>
                        <th class="table_head">Nome</th>
                        <th class="table_head">Numero de séries</th>
                        <th class="table_head">Repetições</th>
                        <th class="table_head">Carga</th>
                        <th class="table_head">Tempo de descanso</th>
                        <th class="table_head">Ações</th>
                    </thead>
                    <tbody>
                        <?php


                        if (isset($_POST['excluir'])) {
                            $id = $_POST['id'];
                            $fichaexercicio->deleteExercicio($id);
                        }
                        foreach ($fichaexercicio->findData($_POST['nome_ficha'], $_POST['id_treino']) as $key => $value) {
                        ?>
                            <tr>

                                <td class="table_body"> <?php echo $value->nome; ?> </td>
                                <td class="table_body"> <?php echo $value->num_serie; ?> </td>
                                <td class="table_body"> <?php echo $value->repeticoes; ?> </td>
                                <td class="table_body"> <?php echo $value->carga; ?> </td>
                                <td class="table_body"> <?php echo $value->tempo_descanso; ?> </td>
                                <td id="acoes">
                                    <div class="alinha_botao">
                                        <form action="../vizualizarExercicios/index.php" method="post">
                                            <button type="submit" name="visualizar">
                                                <span class="icons_table">
                                                    <ion-icon name="eye-outline"></ion-icon>
                                                    <input type="hidden" name="id_exercicio" value="<?php echo $value->fk_exercicio; ?>">
                                                    <input type="hidden" name="nome_ficha" value="<?php echo $_POST['nome_ficha']; ?>">
                                                    <input type="hidden" name="id_treino" value="<?php echo $_POST['id_treino'] ?>">
                                                </span>
                                            </button>
                                        </form>
                                        <form action="#modal_1" method="post">
                                            <button type="submit" name="alterar">
                                                <span class="icons_table">
                                                    <ion-icon name="create-outline"></ion-icon>
                                                    <input type="hidden" name="num_serie" value="<?php echo $value->num_serie; ?>">
                                                    <input type="hidden" name="repeticoes" value="<?php echo $value->repeticoes; ?>">
                                                    <input type="hidden" name="carga" value="<?php echo $value->carga; ?>">
                                                    <input type="hidden" name="tempo_descanso" value="<?php echo $value->tempo_descanso; ?>">
                                                    <input type="hidden" name="id_ficha" value="<?php echo $value->id_fichaExercicio; ?>">
                                                    <input type="hidden" name="nome_ficha" value="<?php echo $_POST['nome_ficha']; ?>">
                                                    <input type="hidden" name="id_treino" value="<?php echo $_POST['id_treino'] ?>">

                                                </span>
                                            </button>
                                        </form>

                                        <form action="" method="post">
                                            <button type="submit" name="excluir">
                                                <span class="icons_table">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                    <input type="hidden" name="nome_ficha" value="<?php echo $_POST['nome_ficha']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $value->id_fichaExercicio; ?>">
                                                    <input type="hidden" name="id_treino" value="<?php echo $_POST['id_treino'] ?>">

                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            <?php } ?>

                            </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </main>
    <div id="modal_1" class="modal">

        <div class="modal__content">
            <h2 class="modal__title">
                <strong>ALTERAR OS VALORES</strong>
            </h2>
            <form action="visualizarExerciciosFicha.php" method="post">
                <div class="text_field">
                    <label for="num_serie">Número de séries</label>
                    <input type="number" name="num_serie" value="<?php $_POST['num_serie']; ?>" required>
                </div>
                <div class="text_field">
                    <label for="repeticoes">Repetições</label>
                    <input type="number" name="repeticoes" value="<?php $_POST['repeticoes']; ?>" required>
                </div>
                <div class="text_field">
                    <label for="carga">Carga(kg)</label>
                    <input type="number" name="carga" value="<?php $_POST['carga']; ?>" required>
                </div>
                <div class="text_field">
                    <label for="descanso">Tempo de descanso</label>
                    <input type="number" name="descanso" value="<?php $_POST['tempo_descanso']; ?>" required>
                </div>
                <input type="hidden" name="id_ficha" value="<?php echo $_POST['id_ficha'] ?>">
                <input type="hidden" name="nome_ficha" value="<?php echo $_POST['nome_ficha']; ?>">
                <input type="hidden" name="id_treino" value="<?php echo $_POST['id_treino'] ?>">
                <div class="div_button">
                    <button type="submit" name="alterar" class="btn_modal">ALTERAR</button>
                </div>
        </div>
        </form>
    </div>


    <asideL>

        <div class="aaa">
            <div class="cont_esq">
                <img src="../../img/logo/logo_braco.png" height="120px">
                <h3 id="text_logo">PoriGYM</h3>
            </div>

            <div class="but_esq">
                <ul>
                    <li class="list">
                        <a href="../dashboard/index.php" class="caixaLateral">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                                <span class="title">Home</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="but_esq">
                <ul>
                    <li class="list">
                        <p class="space">
                            <span class="icon">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                            <span class="title">Usuário</span>
                        </p>
                    </li>
                    <li class="list_inside">
                        <a href="../cadastrarUsuario/index.php" class="caixaLateral">
                            <span class="title_inside">Cadastrar usuário</span>
                        </a>
                    </li>
                    <li class="list_inside">
                        <a href="../visualizarUsuario/index.php" class="caixaLateral">
                            <span class="title_inside">Listar usuários</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="but_esq">
                <ul>
                    <li class="list">
                        <p class="space">
                            <span class="icon">
                                <ion-icon name="barbell-outline"></ion-icon>
                            </span>
                            <span class="title">Treino</span>
                        </p>
                    </li>
                    <li class="list_inside">
                        <a href="#" class="caixaLateral">
                            <span class="title_inside">Criar treinos</span>
                        </a>
                    </li>

                    <li class="list_inside">
                        <a href="../visualizarTreino/index.php" class="caixaLateral">
                            <span class="title_inside">Listar treinos</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="but_esq">
                <ul>
                    <li class="list">
                        <a href="../login/index.php" class="caixaLateral">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                                <span class="title">Sair</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </asideL>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>