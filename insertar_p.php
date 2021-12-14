<?php
include "./extras/connection.php";
$conn = getConnection();
?>

<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Mercado</title>
</head>

<body>
  <h1 class=" text-center display-4 my-5">Productos</h1>
  <div class="container">
    <?php
    if (isset($_GET['res'])) {
      if ($_GET['res'] == 'TRUE') {
        echo '<div class="alert alert-success" role="alert">
          '.$_GET['men'].'
        </div>';
      }else {
        echo '<div class="alert alert-danger" role="alert">
          '.$_GET['men'].'
        </div>';
      }
    }
    ?>
    <a class="btn btn-primary" href="insertar.php">Agregar producto</a>
    <a class="btn btn-primary" href="insertar_categoria.php">Agregar categoria</a>
    <table class="table">
      <thead>
        <th>#</th>
        <th>
          Nombre
        </th>
        <th>
          Categoria
        </th>
        <th>
          Stock
        </th>
        <th>
          Precio
        </th>
        <th>
          Acciones
        </th>
      </thead>
      <tbody>

        <?php

        $query = "SELECT P.ID, P.NOMBRE_P,  C.NOMBRE_CAT, P.STOCK, P.PRECIO FROM PRODUCTO P JOIN CATEGORIA C ON P.CATEGORIA_P = C.ID_CAT";
        $stmt = oci_parse($conn, $query);
        $res = oci_execute($stmt);

        while ($row = oci_fetch_row($stmt)) {
        ?>

          <tr>
            <td> <?php echo $row[0] ?> </td>
            <td> <?php echo $row[1] ?> </td>
            <td> <?php echo $row[2] ?> </td>
            <td> <?php echo $row[3] ?> </td>
            <td> <?php echo $row[4] ?> </td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <a type="button" href="actualizar.php?id=<?php echo $row[0] ?>" class="btn btn-warning">Actualizar</a>
                <a type="button" class="btn btn-danger">Eliminar</a>
              </div>
            </td>
          </tr>

        <?php
        }
        ?>

      </tbody>
    </table>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>