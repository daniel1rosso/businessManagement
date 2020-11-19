<!-- Modal Exitoso -->
<div id="modal-exitoso-insercion" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-check"></span>
                    Exito
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                    Inserción correcta
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning button-ok-modal" data-dismiss="modal">Cerrar</button>							
            </div>            
        </div>
    </div>
</div>

<!-- Modal Importar Clientes -->
<div id="modal-importar-clientes" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Importar Clientes</h4>
            </div>

            <div class="panel-body">        
                <form id="formImportarClientes" role="form">

                    <div class="row">
                        <div class="col-md-12">  
                            <div class="form-group label-floating has-feedback">     
                                <input type="file" name="fileXLSClientes" id="fileXLSClientes">
                                <div id="errorfileXLSClientes" class="btn-danger erroBoxs" style="display: none">
                                    Ingrese un xls para enviar.
                                </div> 
                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>                                
                            </div>    
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button id="btnImportarClientes" class="btn btn-primary btn-raised" onclick="enviarXLSClientes()">Importar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>							
            </div>
        </div>
    </div>
</div>

<!-- Modal Importar Proveedores -->
<div id="modal-importar-proveedores" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Importar Proveedores</h4>
            </div>

            <div class="panel-body">        
                <form id="formImportarProveedores" role="form">

                    <div class="row">
                        <div class="col-md-12">  
                            <div class="form-group label-floating has-feedback">     
                                <input type="file" name="fileXLSProveedores" id="fileXLSProveedores">
                                <div id="errorfileXLSProveedores" class="btn-danger erroBoxs" style="display: none">
                                    Ingrese un xls para enviar.
                                </div> 
                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>                                
                            </div>    
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button id="btnImportarProveedores" class="btn btn-primary btn-raised" onclick="enviarXLSProveedores()">Importar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>							
            </div>
        </div>
    </div>
</div>

<!-- Modal Importar Productos -->
<div id="modal-importar-productos" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Importar Productos</h4>
            </div>

            <div class="panel-body">        
                <form id="formImportarProductos" role="form">

                    <div class="row">
                        <div class="col-md-12">  
                            <div class="form-group label-floating has-feedback">     
                                <input type="file" name="fileXLSProductos" id="fileXLSProductos">
                                <div id="errorfileXLSProductos" class="btn-danger erroBoxs" style="display: none">
                                    Ingrese un xls para enviar.
                                </div> 
                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>                                
                            </div>    
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button id="btnImportarProductos" class="btn btn-primary btn-raised" onclick="enviarXLSProductos()">Importar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>							
            </div>
        </div>
    </div>
</div>
