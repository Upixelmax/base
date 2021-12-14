<?php
  include "./extras/connection.php";
  
  
  $conn = getConnection();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $direccion = $_POST['direccion'];
    $rut = $_POST['rut'];
    $telefono = $_POST['telefono'];
    

    $query = "declare begin INSERTAR_USUARIO(:nombre,:correo,:contraseña,:direccion,:rut,:telefono,:res,:men); end;";

    $stmt = oci_parse($conn,$query);

    oci_bind_by_name($stmt, ":nombre",$nombre);
    oci_bind_by_name($stmt, ":correo",$correo);
    oci_bind_by_name($stmt, ":contraseña",$contraseña);
    oci_bind_by_name($stmt, ":direccion",$direccion);
    oci_bind_by_name($stmt, ":rut",$rut);
    oci_bind_by_name($stmt, ":telefono",$telefono);
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Registro</title>
</head>

<body>

  <h1 class="text-center display-3 mt-5"> Registro </h1>

  <div class="container">
    <div class="mx-5">
      <form action="insertar.php" method="post">

        <div class="mb-3">
          <label for="exampleInputEmail2" class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="exampleInputEmail2">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail4" class="form-label">Correo</label>
          <input type="text" name="correo" class="form-control" id="exampleInputEmail4">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail5" class="form-label">Contraseña</label>
          <input type="text" name="contraseñack" class="form-control" id="exampleInputEmail5">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail5" class="form-label">Direccion</label>
          <input type="text" name="direccion" class="form-control" id="exampleInputEmail5">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail5" class="form-label">RUT</label>
          <input type="text" name="rut" class="form-control" id="exampleInputEmail5">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail5" class="form-label">Teléfono</label>
          <input type="number" name="telefono" class="form-control" id="exampleInputEmail5">
        </div>

        <a type="button" href="insertar_p.php" class="btn btn-warning">Atras</a>
        <button type="submit" class="btn btn-primary"> Enviar </button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>