<?php
date_default_timezone_set('America/Bogota');
setLocale(LC_ALL, "es_CO");

require_once "../models/inventory.php";

class inventoryController extends inventory
{

  public function __construct()
  {
    parent::__construct();
  }

  public function parse($text)
  {
    $parsedText = str_replace(chr(10), "", $text);
    return str_replace(chr(13), "", $parsedText);
  }
}

function trace($test)
{
  echo '<pre>';
  print_r($test);
  echo '</pre>';
}

if (isset($_POST["petition"])) {
  $petition = $_POST["petition"];
  $IC = new inventoryController();

  $response = [
    "state" => false,
    "message" => "Hubo un error al procesar la petición"
  ];

  switch ($petition) {

    case 'create':
      $params = [
        "name" => utf8_decode($_POST['name']),
        "price" => $_POST['price'],
        "category" => $_POST['category'],
        "amount" => $_POST['amount'],
        "reference" => $_POST['reference'],
      ];

      $sqlGuardar = $IC->create($params);

      if ($sqlGuardar) {
        $response = [
          "state" => true,
          "message" => "Producto agregado"
        ];
      } else {
        $response = [
          "state" => false,
          "message" => "Error al agregar"
        ];
      }

      echo json_encode($response);
      break;

    case 'list':

      $dataSQL = $IC->listProducts();

      $data = "";

      foreach ($dataSQL as $item) {
        $option =
          '
        <button data-id-button=\"' . $item['id_product'] . '\" type=\"button\" class=\"edit btn btn-info btn-sm text-white\"><span class=\"mdi mdi-pencil\"></span></button>
        <button data-id-button=\"' . $item['id_product'] . '\" type=\"button\" class=\"delete btn btn-danger btn-sm\"><span class=\"mdi mdi-delete\"></span></button>
      ';
        $data .= '{
        "Nombre":"' . utf8_encode($item['name']) . '",
        "Referencia":"' . utf8_encode($item['reference']) . '",
        "Precio":"' . utf8_encode($item['price']) . '",
        "Categoria":"' . utf8_encode($item['category_name']) . '",
        "Cantidad":"' . utf8_encode($item['amount']) . '",
        "Creado":"' . utf8_encode($item['created_at']) . '",
        "Ultima venta":"' . utf8_encode($item['updated_at']) . '",
        "Opciones":"' . $IC->parse($option) . '"
      },';
      }

      $data = substr($data, 0, strlen($data) - 1);

      echo '{"data":[' . $data . ']}';
      break;

    case 'consult':
      $params = [
        "id" => $_POST['id']
      ];

      $dataSQLProducts = $IC->consult($params);
      $dataSQLCategories = $IC->consultCategories();
      if ($dataSQLProducts) {
        $dataProducts = [
          "id" => $dataSQLProducts[0]['id_product'],
          "name" => utf8_encode($dataSQLProducts[0]['name']),
          "reference" => utf8_encode($dataSQLProducts[0]['reference']),
          "price" => utf8_encode($dataSQLProducts[0]['price']),
          "category_id" => utf8_encode($dataSQLProducts[0]['category_id']),
          "category_name" => utf8_encode($dataSQLProducts[0]['category_name']),
          "amount" => utf8_encode($dataSQLProducts[0]['amount']),
          "created_at" => utf8_encode($dataSQLProducts[0]['created_at']),
          "updated_at" => utf8_encode($dataSQLProducts[0]['updated_at'])
        ];
        $htmlCategories = "";
        foreach ($dataSQLCategories as $item) {
          $htmlCategories .= "
            <option value='{$item['id_category']}'> " . utf8_encode($item['name']) . " </option>
          ";
        }

        $response = [
          "state" => true,
          "dataProducts" => $dataProducts,
          "htmlCategories" => $htmlCategories
        ];
      } else {
        $response = [
          "state" => false,
          "message" => 'Error al consultar los datos'
        ];
      }

      echo json_encode($response);
      break;

      //ACTUALIZAR
    case 'updated':
      $params = [
        "name" => utf8_decode($_POST['name']),
        "price" => $_POST['price'],
        "category" => $_POST['category'],
        "id" => $_POST['id']
      ];

      $data = $IC->updated($params);

      if ($data) {
        $response = [
          "state" => true,
          "message" => "Actualizado correctamente"
        ];
      } else {
        $response = [
          "state" => false,
          "message" => "Error al actualizar"
        ];
      }

      echo json_encode($response);
      break;

    case 'delete':
      $params = [
        "id" => $_POST['id']
      ];

      $data = $IC->delete($params);

      if ($data) {
        $response = [
          "state" => true,
          "message" => "Producto eliminado"
        ];
      } else {
        $response = [
          "state" => false,
          "message" => "Error al Eliminar"
        ];
      }

      echo json_encode($response);
      break;

    case 'listCategories':
      $dataSQLCategories = $IC->consultCategories();
      $htmlCategories = "";
      $htmlCategories = "<option selected>Seleccionar...</option>";
      foreach ($dataSQLCategories as $item) {
        $htmlCategories .= "
          <option value='{$item['id_category']}'> " . utf8_encode($item['name']) . " </option>
        ";
      }

      $response = [
        "state" => true,
        "htmlCategories" => $htmlCategories
      ];
      echo json_encode($response);
      break;
  }
}
