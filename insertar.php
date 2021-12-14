<?php
  include "./extras/connection.php";
  
  
  $conn = getConnection();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    

    $query = "declare begin INSERTAR_PRODUCTO(:nombre,:categoria,:precio,:stock,:res,:men); end;";

    $stmt = oci_parse($conn,$query);

    oci_bind_by_name($stmt, ":nombre",$nombre);
    oci_bind_by_name($stmt, ":precio",$precio);
    oci_bind_by_name($stmt, ":categoria",$categoria);
    oci_bind_by_name($stmt, ":stock",$stock);
    oci_bind_by_name($stmt, ":res",$res,100);
    oci_bind_by_name($stmt, ":men",$men,100);

    $response =oci_execute($stmt);

    if ($response) {
      header("location: /BASE/insertar_p.php?res=".$res."&men=".$men);
    }

  }



  $query = "select * from categoria";

  $stmt = oci_parse($conn, $query);
  $res = oci_execute($stmt);

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

  <h1 class="text-center display-3 mt-5"> Insertar producto </h1>

  <div class="container">
    <div class="mx-5">
      <form action="insertar.php" method="post">

        <div class="mb-3">
          <label for="exampleInputEmail2" class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="exampleInputEmail2">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail3" class="form-label">Categoria</label>
          <select class="form-select" name="categoria" >
            <?php
            while($row = oci_fetch_row($stmt)){
            ?>
              <option value="<?php echo $row[0]?>"> <?php echo $row[1]?> </option>
            <?php } ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail4" class="form-label">Precio</label>
          <input type="number" name="precio" class="form-control" id="exampleInputEmail4">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail5" class="form-label">Stock</label>
          <input type="number" name="stock" class="form-control" id="exampleInputEmail5">
        </div>
        <a type="button" href="insertar_p.php" class="btn btn-warning">Atras</a>
        <button type="submit" class="btn btn-primary"> Enviar </button>
      </form>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>