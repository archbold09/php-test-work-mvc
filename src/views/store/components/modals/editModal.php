<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row" id="editForm">
                    <div class="col-6 my-1">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="nameEdit">
                    </div>
                    <div class="col-6 my-1">
                        <label>Precio</label>
                        <input type="number" class="form-control" id="priceEdit">
                    </div>
                    <div class="col-8 my-1">
                        <label>Categoria</label>
                        <select class="custom-select" id="categoryEdit">
                            <option selected>Seleccionar...</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnEdit">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>