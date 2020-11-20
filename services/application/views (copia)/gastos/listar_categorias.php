<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
                <div class="page-title">
                        <h3>Categorías de gasto<small>Listar</small></h3>
                </div>
        </div>
        
        
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?=$url?>dashboard">Home</a></li>
                <li class="active">Gastos</li>
                <li class="active">Categorías de gasto</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->
        
        <div class="form-actions text-right">
            <a data-toggle="modal" class="btn btn-primary" onclick="vaciadoCategoriasGastos()">
                <i class="icon-plus"></i>
                Agregar Categoría de gasto
            </a>
        </div>
      
        
        <!---->
        
        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#modal-nueva-categoria-gastos" data-toggle="tab">
                        <i class="fas fa-truck-loading" style="font-size:1.4em;"></i> 
                        Categorías de gasto
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="CategoriasGastos">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoCategoriasGastos">
                                <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($categorias_gastos)) : ?>
                                        <?php foreach ($categorias_gastos as $key => $value) : ?>
                                            <tr id="<?=$value['idCategoriaGasto']?>">
                                                <td class="text-center"><?=$value['descripcion']?></td>
                                                <td class="text-center">
                                                    <a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_categorias_gastos" data-id="<?=$value['idCategoriaGasto']?>" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>
                                                    &nbsp;
                                                    <a role="button" data-toggle="modal" class="tip update_categorias_gastos" onclick="llenadoModalEditarGasto(<?=$value['idCategoriaGasto']?>)" data-original-title="Editar"><i class="icon-pencil3"></i></a>
                                                    <!-- <a href="#modal-modificar-categoria-gastos" role="button" data-toggle="modal" class="tip update_categorias_gastos" data-id="<?=$value['idCategoriaGasto']?>" data-descripcion="<?=$value['descripcion']?>" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a> -->
                                                </td>
                                            </tr>				                        
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>            
            </div>
        </div>