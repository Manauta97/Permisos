<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>
 <div class="container">
        <div class="row">
            <div class="col-12 p-5 text-center">
                <h1><?php echo $datos['usuarioSesion']->user_nombre ?></h1>
                <H4>TU HORARIO</H4>
            </div>
            
<table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">HORA</th>
        <th scope="col">LUNES</th>
        <th scope="col">MARTES</th>
        <th scope="col">MIÉRCOLES</th>
        <th scope="col">JUEVES</th>
        <th scope="col">VIERNES</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">18:00</th>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>ATLETISMO</td>
        <td>-</td>
      </tr>
      <tr>
        <th scope="row">18:30</th>
        <td>-</td>
        <td>ATLETISMO</td>
        <td>-</td>
        <td>ATLETISMO</td>
        <td>-</td>
      </tr>
      <tr>
        <th scope="row">19:00</th>
        <td>-</td>
        <td>ATLETISMO</td>
        <td>-</td>
        <td>ATLETISMO</td>
        <td>-</td>
      </tr>
      <tr>
        <th scope="row">19:30</th>
        <td>-</td>
        <td>ATLETISMO</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
      </tr>
      <tr>
        <th scope="row">20:00</th>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
      </tr>
      <tr>
        <th scope="row">20:30</th>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
      </tr>
      <tr>
        <th scope="row">21:00</th>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
      </tr>
      <tr>
        <th scope="row"></th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
            <div class="col-12 p-5 text-center">
                <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                    Salir
                  </button>
            </div>
            
        </div>
    </div>
    <?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>