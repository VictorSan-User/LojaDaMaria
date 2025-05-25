<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meu Negócio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/meunegocio.css">
</head>
<body class="bg-light">

  <div class="container py-5 p-4 bg-white rounded shadow">
    <h1 class="mb-4 text-center">Painel de Gerenciamento</h1>
    <!-- list group -->
    <div class="list-group">
      <a href="criarAgendamento.html" class="list-group-item list-group-item-action">
        <i class="bi bi-bookmark-plus me-2"></i>
        Criar Novo Agendamento
      </a>
      <a href="editarAgenamentos.html" class="list-group-item list-group-item-action">
        <i class="bi bi-pencil-fill me-2"></i>
        Editar Agendamento Existente
      </a>
      <a href="listarAgendamentosFuturos.php" class="list-group-item list-group-item-action">
        <i class="bi bi-calendar-event me-2"></i> 
        Listar Agendamentos Futuros
      </a>
      <a href="listarAgendamentosPassados.php" class="list-group-item list-group-item-action">
        <i class="bi bi-bookmark-check-fill me-2"></i>
        Listar Agendamentos Passados
      </a>
      <a href="excluirAgendamento.html" class="list-group-item list-group-item-action text-danger">
        <i class="bi bi-trash-fill me-2"></i>
        Excluir Agendamento
      </a>
    </div>
    <button class="btn btn-primary d-block mx-auto m-3 px-5">
      <a href="index.php" class="ajustes_links text-white">
        Voltar
      </a>
    </button>
  </div>

  <footer class="bg-primary text-white text-center py-3 mt-auto fixed-bottom">
    &copy; 2025 | Todos os Direitos Reservados
  </footer>

</body>
</html>
