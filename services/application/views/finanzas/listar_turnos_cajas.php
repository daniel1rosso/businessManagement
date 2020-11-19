<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Turnos de Cajas<small>Listar</small></h3>
            </div>
        </div>


        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?= $url ?>dashboard">Home</a></li>
                <li class="active">Finanzas</li>
                <li class="active">Turnos de Cajas</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->

<!--        <div class="form-actions text-right">
            <a data-toggle="modal" class="btn btn-primary" onclick="vaciadoCategoriasGastos()">
                <i class="icon-plus"></i>
                Agregar Categoría de gasto
            </a>
        </div>-->


        <!---->

        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#modal-nueva-categoria-gastos" data-toggle="tab">
                        <i class="fas fa-file-signature" style="font-size:1.4em;"></i>
                        Turnos de cajas
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="turnosCajas">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoTurnosCajas">
                                <thead>
                                    <tr>
                                        <th class="text-center">id</th>
                                        <th class="text-center">Apellido</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Rol</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div>            
            </div>
        </div>