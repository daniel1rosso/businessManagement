<!--Page container -->
<div class="page-container">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-content">
            <!-- User dropdown -->
            <div class="user-menu dropdown" onclick="abrirMenuPrincipal();">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo(empty($usuario['imgPerfil'])) ? $url . 'assets/images/home-3-inner-rev-2-img-3.png' : $url . '/uploads/perfiles/thumbs/' . $usuario['imgPerfil'] ?>">
                    <div class="user-info">
                        <?= $userdata['nombreCompleto'] ?> ( <?= $nivelUsuario ?> )
                        <span style="color: white; text-decoration: underline;">Ir al panel principal</span>
                    </div>
                </a>
            </div>
            <!-- /user dropdown -->

            <!-- Main navigation -->
            <ul class="navigation">
                <?php
                //ver como hacer para los sublitems

                if ($menu) {
                    foreach ($menu as $key => $value) {

                        if ($menu[$key]['idTipoInterna'] == 1) {
                            echo '<li>' .
                            '<a href="' . $url . $menu[$key]['link'] . '">' .
                            '<span>' . $menu[$key]['nombre'] . '</span>' .
                            '<i class="' . $menu[$key]['icono'] . '"></i></a>';
                            
                            for ($j = 0; $j < count($menu); $j++) {
                                if ($menu[$j]['idTipoInterna'] == 2) {
                                    if ($menu[$j]['idSubItem'] == $value['posicion']) {
                                        echo '<ul><li>' .
                                        '<a href="' . $url . $menu[$j]['link'] . '">' .
                                        '<span>' . $menu[$j]['nombre'] . '</span>' .
//                                        '<i class="' . $menu[$j]['icono'] . '"></i>
                                        '</a>';

                                        for ($k = 0; $k < count($menu); $k++) {
                                            if ($menu[$k]['idTipoInterna'] == 3 && $menu[$j]['posicion'] == $menu[$k]['idSubItem']) {
                                                echo '<ul><li>' .
                                                '<a href="' . $url . $menu[$k]['link'] . '">' .
                                                '<span>' . $menu[$k]['nombre'] . '</span>' .
//                                                '<i class="' . $menu[$k]['icono'] . '"></i>
                                                '</a>';

                                                for ($l = 0; $l < count($menu); $l++) {
                                                    if ($menu[$l]['idTipoInterna'] == 4 && $menu[$k]['posicion'] == $menu[$l]['idSubItem']) {
                                                        echo '<ul><li>' .
                                                        '<a href="' . $url . $menu[$l]['link'] . '">' .
                                                        '<span>' . $menu[$l]['nombre'] . '</span>' .
        //                                                '<i class="' . $menu[$k]['icono'] . '"></i>
                                                        '</a>';
                                                        echo "</li></ul>";
                                                    }
                                                }
                                                echo "</li></ul>";
                                            }
                                        }
                                        echo "</li></ul>";
                                    }
                                }
                            }
                            echo "</li>";
                        }
                    }
                }
                ?>

            </ul>
            <!-- /main navigation -->
        </div>
    </div>

<!-- /sidebar -->
