<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Agendamentos Futuros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="mb-4 text-center">Agendamentos a Ocorrer</h1>

  <!-- <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Data Inicial</th>
        <th>Data Final</th>
        <th>Título</th>
        <th>Cliente</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(empty($agendamentos)) {
            echo "<tr><td colspan='6' class='text-center'>Nenhum agendamento encontrado</td></tr>";
        } else {
            foreach($agendamentos as $ag) {
              echo '<div id="lista-futuros" class="d-flex flex-column align-items-center"></div>';
            }
          }
      ?>
    </tbody>
  </table> -->

  <a href="meuNegocio.php" class="btn btn-secondary d-block mx-auto mt-3">Voltar</a>
</div>

</body>
</html>
