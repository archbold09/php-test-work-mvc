<?php include('./components/includes/Header.php'); ?>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand px-5" href="#">Archbold Angel</a>
</nav>

<div class="container">
    <div class="row">
        <main class="col-12 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Inventario</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#createModal">Crear producto</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped table-sm" id="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Referencia</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <th>Cantidad</th>
                            <th>Creado</th>
                            <th>Ultima venta</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Modals -->
<?php include('./components/modals/editModal.php'); ?>
<?php include('./components/modals/createModal.php'); ?>

<!-- JS -->
<?php include('../../assets/js/js.php'); ?>
<!-- Custom scripts -->
<script src="../../assets/js/home/inventory.js" type="text/javascript"></script>


</body>
</html>