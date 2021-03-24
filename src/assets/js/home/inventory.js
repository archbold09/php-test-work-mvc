const URL = "../../../controllers/inventoryControllers.php";
var table;
$(document).ready(function () {
  $(function () {
    list();
    listCategories();
  });

  $("#btnCreate").click(function () {
    let nameCreate = $("#nameCreate").val();
    let priceCreate = $("#priceCreate").val();
    let referenceCreate = $("#referenceCreate").val();
    let amountCreate = $("#amountCreate").val();
    let categoryCreate = $("#categoryCreate").val();
    
    if (nameCreate.length > 0 && priceCreate.length > 0 && amountCreate > 0 && categoryCreate > 0) {
      $.ajax({
        type: "POST",
        url: URL,
        data: {
          name: nameCreate,
          price: priceCreate,
          reference: referenceCreate,
          amount: amountCreate,
          category:categoryCreate,
          petition: "create",
        },
        dataType: "JSON",
      }).done(function (data) {
        if (data.state) {
          //Envia los datos por ajax para que se carguen
          $("#createForm")[0].reset();
          $("#createModal").modal("hide");
          table.ajax.reload();
          swal({
            title: data.message,
            icon: "success",
            button: "Cerrar",
          });
        } else {
          swal({
            title: data.message,
            icon: "error",
            button: "Cerrar",
          });
        }
      });
    } else {
      swal({
        title: "Por favor completar los campos",
        icon: "warning",
        button: "Cerrar",
      });
    }
  });

  function list() {
    table = $("#table").DataTable({
      select: true,
      searching: true,
      bDeferRender: true,
      sPaginationType: "full_numbers",
      ajax: {
        url: URL,
        type: "POST",
        data: {
          petition: "list",
        },
        dataSrc: function (json) {
          return json.data;
        },
      },
      columns: [
        { data: "Nombre" },
        { data: "Referencia" },
        { data: "Precio" },
        { data: "Categoria" },
        { data: "Cantidad" },
        { data: "Creado" },
        { data: "Ultima venta" },
        { data: "Opciones" },
      ],
      oLanguage: {
        sProcessing: "Procesando...",
        sLengthMenu:
          "Mostrar <select>" +
          '<option value="10">10</option>' +
          '<option value="20">20</option>' +
          '<option value="30">30</option>' +
          '<option value="40">40</option>' +
          '<option value="50">50</option>' +
          '<option value="-1">All</option>' +
          "</select> registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta table",
        sInfo:
          "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Por favor espere - cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
    });
    table.on("draw", function (e, settings, details) {
      deleteValidation();
      consult();
    });
  }

  function listCategories() {
    $.ajax({
      type: "POST",
      url: URL,
      data: {
        petition: "listCategories",
      },
      dataType: "JSON",
    }).done(function (data) {
      $("#categoryCreate").html(data.htmlCategories);
    });
  }

  function consult() {
    $("#table")
      .find("button.edit")
      .each(function () {
        $(this).unbind("click");
        $(this).click(function () {
          let idT = $(this).attr("data-id-button");

          $.ajax({
            type: "POST",
            url: URL,
            data: {
              id: idT,
              petition: "consult",
            },
            dataType: "JSON",
          }).done(function (data) {
            if (data.state) {
              $("#btnEdit").data("idTi", data.dataProducts.id);
              $("#nameEdit").val(data.dataProducts.name);
              $("#priceEdit").val(data.dataProducts.price);
              $("#categoryEdit").html(data.htmlCategories);
              $("#categoryEdit").val(data.dataProducts.category_id);
              $("#editModal").modal("show");

              edit();
            } else {
              swal({
                title: data.message,
                icon: "error",
                button: "Cerrar",
              });
            }
          });
        });
      });
  }

  function edit() {
    $("#btnEdit").unbind("click");
    $("#btnEdit").click(function () {
      let nameEdit = $("#nameEdit").val();
      let priceEdit = $("#priceEdit").val();
      let categoryEdit = $("#categoryEdit").val();
      let idT = $("#btnEdit").data("idTi");

      if (nameEdit.length > 0 && categoryEdit > 0) {
        $.ajax({
          type: "POST",
          url: URL,
          data: {
            name: nameEdit,
            price: priceEdit,
            category: categoryEdit,
            id: idT,
            petition: "updated",
          },
          dataType: "JSON",
        }).done(function (data) {
          if (data.state) {
            table.ajax.reload();
            $("#editModal").modal("hide");

            swal({
              title: data.message,
              icon: "success",
              button: "Cerrar",
            });
          } else {
            swal({
              title: data.message,
              icon: "error",
              button: "Cerrar",
            });
          }
        });
      } else {
        alert_error("Por favor llene todos los campos");
      }
    });
  }

  function deleteValidation() {
    $("#table")
      .find("button.delete")
      .each(function () {
        $(this).unbind("click");
        $(this).click(function () {
          let idT = $(this).attr("data-id-button");
          swal({
            title: "Seguro que desea eliminar el producto?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((value) => {
            if (value) {
              $.ajax({
                type: "POST",
                url: URL,
                data: {
                  id: idT,
                  petition: "delete",
                },
                dataType: "JSON",
              }).done(function (data) {
                if (data.state) {
                  table.ajax.reload();
                  swal({
                    title: data.message,
                    icon: "success",
                    button: "Cerrar",
                  });
                } else {
                  swal({
                    title: data.message,
                    icon: "error",
                    button: "Cerrar",
                  });
                }
              });
            }
          });
        });
      });
  }
});
