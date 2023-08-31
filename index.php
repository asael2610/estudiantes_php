<!doctype html>
<html lang="en">

<head>
  <title>PAGINA PHP</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body bgcolor="red">
    
    <h1>Formulario Estudiantes</h1>
    <div class="container">
        <form class="d-flex" action="crud_estudiantes.php" method="post">
          <div class="col">
          <div class="mb-3">
              <label for="lbl_id" class="form-label"><b>ID</b></label>
              <input type="text" name="txt_id" id="txt_id" class="form-control" value="0"  readonly>
            </div>

            <div class="mb-3">
              <label for="lbl_Carne" class="form-label"><b>Carne</b></label>
              <input type="text" name="txt_carne" id="txt_carne" class="form-control" placeholder="Carne: E001" required>
            </div>
            <div class="mb-3">
              <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
              <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombres: Nombre1 Nombres2" required>
            </div>
            <div class="mb-3">
              <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
              <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellidos: Apellido1 Apellido2" required>
            </div>
            <div class="mb-3">
              <label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
              <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Direccion: #casa calle avenida lugar" required>
            </div>
            <div class="mb-3">
              <label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
              <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="Telefono: 55552222" required>
            </div>
            <div class="mb-3">
              <label for="lbl_direccion" class="form-label"><b>Correo Electronico</b></label>
              <input type="text" name="txt_correo" id="txt_correo" class="form-control" placeholder="Correo: ejemplo@gmail.com" required>
            </div>
            <div class="mb-3">
              <label for="lbl_puesto" class="form-label"><b>Tipo Sangre</b></label>
              <select class="form-select" name="drop_sangre" id="drop_sangre">

              <?php 
                 include("datos_conexion.php");
                 $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre,$db_puerto);
                 $db_conexion -> real_query ("SELECT id_tipos_sangre as id,sangre FROM tipos_sangre;");
                $resultado = $db_conexion -> use_result();
                while ($fila = $resultado ->fetch_assoc()){
                  echo "<option value=". $fila['id'].">". $fila['sangre']."</option>";

                }
                $db_conexion ->close();

                ?>



              </select>
            </div>
            <div class="mb-3">
              <label for="lbl_fn" class="form-label"><b>Fecha Nacimiento</b></label>
              <input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="aaaa-mm-dd" required>
            </div>
            <div class="mb-3">
              <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value = "Agregar">
              <input type="submit" name="btn_modificar" id="btn_modificar" class="btn btn-success" value = "Modificar">
                <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-danger" onclick="javascript:if(!confirm('¿Desea Eliminar?'))return false" value = "Eliminar">
                <input type="submit" name="btn_nuevo" id="btn_nuevo" class="btn btn-secondary" onclick="limpiar()" value = "Nuevo">

            </div>

            </div>
        </form>

<table class="table table-striped table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
        <th>Carne</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Correo Electronico</th>
        <th>Tipo Sangre</th>
        <th>Nacimiento</th>
      </tr>
      </thead>
      <tbody id="tbl_estudiantes">
       <?php 
       include("datos_conexion.php");
       $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre,$db_puerto);
       $db_conexion -> real_query ("SELECT e.id_estudiante as id,e.carne,e.nombres,e.apellidos,e.direccion,e.telefono,e.correo_electronico,s.sangre,e.fecha_nacimiento,s.id_tipos_sangre FROM estudiantes as e inner join tipos_sangre as s on e.id_tipos_sangre = s.id_tipos_sangre;");
      $resultado = $db_conexion -> use_result();
      while ($fila = $resultado ->fetch_assoc()){
        echo "<tr data-id=". $fila['id']." data-idp=". $fila['id_tipos_sangre'].">";
        echo "<td>". $fila['carne']."</td>";
        echo "<td>". $fila['nombres']."</td>";
        echo "<td>". $fila['apellidos']."</td>";
        echo "<td>". $fila['direccion']."</td>";
        echo "<td>". $fila['telefono']."</td>";
        echo "<td>". $fila['correo_electronico']."</td>";
        echo "<td>". $fila['sangre']."</td>";
        echo "<td>". $fila['fecha_nacimiento']."</td>";
        echo "</tr>";

      }
      $db_conexion ->close();
       ?>
      </tbody>
  </table>

        </div>
  



  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

<script>
$('#tbl_estudiantes').on('click','tr td',function(evt){
        var target,id,idp,carne,nombres,apellidos,direccion,telefono,correo,nacimiento;
        target = $(event.target);
        id = target.parent().data('id');
        idp = target.parent().data('idp');
        carne = target.parent("tr").find("td").eq(0).html();
        nombres = target.parent("tr").find("td").eq(1).html();
        apellidos =  target.parent("tr").find("td").eq(2).html();
        direccion = target.parent("tr").find("td").eq(3).html();
        telefono = target.parent("tr").find("td").eq(4).html();
        correo = target.parent("tr").find("td").eq(5).html();
        nacimiento  = target.parent("tr").find("td").eq(7).html();

        $("#txt_id").val(id);
        $("#txt_carne").val(carne);
        $("#txt_nombres").val(nombres);
        $("#txt_apellidos").val(apellidos);
        $("#txt_direccion").val(direccion);
        $("#txt_telefono").val(telefono);
        $("#txt_correo").val(correo);
        $("#txt_fn").val(nacimiento);
        $("#drop_sangre").val(idp);
        $("#modal_estudiantes").modal('show');
});


</script>


</body>

</html>