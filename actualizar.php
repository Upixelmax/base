<?php
  include "./extras/connection.php";
  
  
  if ($_SERVER['REQUEST_METHOD'] =='POST') {
    //  llamado a procedimiento
    header("location: ./BASE/insertar_p.php");
  }
  
  $conn = getConnection(); 
  $query = "SELECT P.ID, P.NOMBRE_P,  C.NOMBRE_CAT, P.STOCK, P.PRECIO 
            FROM PRODUCTO P JOIN CATEGORIA C ON P.CATEGORIA_P = C.ID_CAT
            WHERE ID = :id";
  

  $stmt = oci_parse($conn,  $query);
  $id = $_GET['id'];

  oci_bind_by_name($stmt, ":id", $id );
  
  oci_execute($stmt);

  $row = oci_fetch_row($stmt);

  if ($row == false) {
    header("location: /BASE/insertar_p.php");
  }

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>

  <h1 class="text-center display-3 mt-5"> Actualizar producto </h1>

  <div class="container">
    <div class="mx-5">
      <form action="actualizar.php" method="post">

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">#</label>
          <input type="number" class="form-control" value="<?php echo $row[0] ?>" disabled id="exampleInputEmail1">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail2" class="form-label">Nombre</label>
          <input type="text" class="form-control" value="<?php echo $row[1] ?>" id="exampleInputEmail2">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail3" class="form-label">Categoria</label>
          <input type="text" class="form-control" value="<?php echo $row[2] ?>" id="exampleInputEmail3">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail4" class="form-label">Stock</label>
          <input type="number" class="form-control" value="<?php echo $row[3] ?>" id="exampleInputEmail4">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail5" class="form-label">Precio</label>
          <input type="number" class="form-control" value="<?php echo $row[4] ?>" id="exampleInputEmail5">
        </div>
        <a type="button" href="insertar_p.php" class="btn btn-warning">Atras</a>
        <button type="submit" class="btn btn-primary" > Enviar </button>
      </form>
    </div>
  </div>

 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>