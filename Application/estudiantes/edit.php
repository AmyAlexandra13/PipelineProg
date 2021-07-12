<?php
require_once 'estudiante.php';
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'serviceSession.php';
require_once 'ServiceCookies.php';

$layout = new Layout();
$service = new ServiceCookies();
$utilities = new Utilities();

$estudiante = null;

if (isset($_GET["id"])) {

    $estudiante = $service->GetById($_GET["id"]);
}

if (isset($_POST["estudianteId"]) && isset($_POST["EstudianteName"]) && isset($_POST["EstudianteApellido"]) && isset($_POST["EstudianteCarrera"])) {

    $status = ($_POST["Status"] == "activo") ? true : false;

    $estudiante = new Estudiante($_POST["estudianteId"], $_POST["EstudianteName"], $_POST["EstudianteApellido"], $_POST["EstudianteCarrera"], $status);

    $service->Edit($estudiante);

    header("Location: ../index.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>

    <?php echo $layout->printHeader() ?>

    <?php if ( $estudiante == null) : ?>
        <h2>Lamentablemente, no existe este estudiante</h2>
        <?php  var_dump($estudiante) ?>
    <?php else : ?>

        <form action="edit.php" method="POST">
        <?php  var_dump($estudiante) ?>
            <input type="hidden" name="estudianteId" value="<?=  $estudiante->Id ?>">
                    <div class="mb-3">
                        <label for="estudiante-name" class="form-label">Nombre del estudiante</label>
                        <input name="EstudianteName" value="<?php echo $estudiante->Nombre ?>" type="text" class="form-control" id="estudiante-name">

                    </div>
                    <div class="mb-3">
                        <label for="estudiante-apellido" class="form-label">Apellido del estudiante</label>
                        <input name="EstudianteApellido" value="<?php echo $estudiante->Apellido ?>" type="text" class="form-control" id="estudiante-apellido">
                    </div>
                    <div class="mb-3">
                        <label for="estudiante-carrera" class="form-label">Carrera del estudiante</label>
                        <select name="EstudianteCarrera" class="form-select" id="estudiante-carrera">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($utilities->carreras as $valor => $texto) : ?>

                                <?php if ($valor == $estudiante->Carrera) : ?>
                            <option selected value="<?php echo $valor; ?>"> <?= $texto ?> </option>
                        <?php else : ?>
                            <option value="<?php echo $valor; ?>"> <?= $texto ?> </option>
                        <?php endif; ?>

                            <?php endforeach; ?>
                        </select>
            </div>

           

            <a href="../index.php" class="btn btn-warning">Volver atras </a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    <?php endif; ?>




    <?php echo $layout->printFooter() ?>

</body>

</html>