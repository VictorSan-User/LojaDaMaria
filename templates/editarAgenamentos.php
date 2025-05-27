<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Agendamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../templates/img/favicon.png" type="image/x-icon">

</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Editar Agendamento</h4>
                </div>
                <div class="card-body">
                    <form action="../Controllers/ControllerEditarAgendamento.php" method="POST">

                        <input type="hidden" name="id" value="<?= htmlspecialchars($result['id']) ?>">

                        <div class="mb-3">
                            <label for="data_inicial" class="form-label">Data Inicial</label>
                            <input type="date" class="form-control" id="data_inicial" name="data_inicial"
                                value="<?= htmlspecialchars($result['data_inicial']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="data_final" class="form-label">Data Final</label>
                            <input type="date" class="form-control" id="data_final" name="data_final"
                                value="<?= htmlspecialchars($result['data_final']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo"
                                value="<?= htmlspecialchars($result['titulo']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?= htmlspecialchars($result['descricao']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cliente" class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="cliente" name="cliente"
                                value="<?= htmlspecialchars($result['cliente']) ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
                        <button class="col-12 btn btn-secondary d-block mx-auto m-3 my-1 px-5">
                            <a href="meuNegocio.php" class="text-decoration-none text-white">
                                Voltar
                            </a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
