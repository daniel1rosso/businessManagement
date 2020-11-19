<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Libro de IVA Compras<small>Listar</small></h3>
            </div>
        </div>

        <!---->

        <?php if (isset($successModif)) : ?>
            <div class="callout callout-success fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5>¡Bien!</h5>
                <p>Se modificó el movimiento con éxito.</p>
            </div>
        <?php endif; ?>

        <!---->


        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?= $url ?>dashboard">Home</a></li>
                <li>Libros</li>
                <li class="active">Libro de IVA Compras</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>            

        <br><br>

        <!---->

        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#libroivacompra" data-toggle="tab">
                        <i class="fas fa-book-open" style="font-size:1.4em;"></i> 
                        Libro de IVA Compras
                    </a>
                </li>	  	                 
            </ul>
            <!---->
            
                <ul class="page-stats list-justified">
                    <li class="bg-primary text-center" style="background: #2B45E0;">
                        <div class="page-stats-showcase" style="float:none;">
                            <span id="textoTotalIvaCompras">
                                Total IVA Compra
                            </span>
                            <h2><div id="totalIVACompras"><?= $total ?></div></h2>
                        </div>
                    </li>
                </ul>        
            
            <!---->            
            <div class="tab-content">
                <div class="tab-pane active fade in" id="libroIVACompras">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="container" style="padding-top:15px;width:100%;">
                            <div class="col-md-1 pull-left" style="padding-top: 5px;width: 42px;font-weight: 600;">
                                Fecha:
                            </div>
                            <div class="col-md-4 pull-left">
                                <div class="input-group input-daterange">
                                    <div class="input-group-addon">Desde</div>
                                    <input type="text" id="min-date-listado-libro-iva-compra" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" onblur="aplicarFiltrolibroIVACompras()" autocomplete="off">
                                    <div class="input-group-addon">Hasta</div>
                                    <input type="text" id="max-date-listado-libro-iva-compra" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" onblur="aplicarFiltrolibroIVACompras()" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoLibroIVACompras">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Cliente</th>
                                        <th>CUIT</th>
                                        <th>Condici&oacute;n frente al iva</th>
                                        <th>N° Comprobante</th>
                                        <th>Importe Total Facturado</th>
                                        <th>Importe no gravados</th>
                                        <th>IVA D&eacute;bito Fiscal</th>
                                        <th>Descripci&oacute;n</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div>            
            </div>
        </div>
