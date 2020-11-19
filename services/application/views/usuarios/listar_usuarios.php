<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Usuarios<small>Listar</small></h3>
            </div>
        </div>

        <!---->

        <?php if (isset($successModif)) : ?>
            <div class="callout callout-success fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5>¡Bien!</h5>
                <p>Se modificó el usuario con éxito.</p>
            </div>
        <?php endif; ?>

        <!---->

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?= $url ?>dashboard">Home</a></li>
                <li class="active">Usuarios</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->

        <div class="form-actions text-right">
            <a href="#modal-add-usuario" data-toggle="modal" data-original-title="Listar" class="btn btn-primary"  onclick="resetFormUsuario()">
                <i class="icon-plus"></i>
                Agregar Usuario
            </a>
        </div>

        <!---->

        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#usuarios" data-toggle="tab">
                        <i class="fa fa-newspaper-o" style="font-size:1.4em;"></i> 
                        Usuario
                    </a>
                </li>	  
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="rubros">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i>Usuarios</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoUsuarios">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Apellido y Nombre</th>
                                        <th>Nombre de usuario</th>
                                        <th>Email</th>
                                        <th>Nivel</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>