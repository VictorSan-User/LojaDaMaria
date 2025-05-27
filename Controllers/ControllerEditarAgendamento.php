<?php
include 'Database.php';
include 'ControllerAgendamentos.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("<p style='color:red;'>Requisição inválida!</p>");
}

$connection = Database::connect();

$id = $_POST['id'] ?? null;
$titulo = $_POST['titulo'] ?? '';

if (!is_numeric($id)) {
    die("<p style='color:red;'>ID inválido!</p>");
}

$compromisso = new Compromisso($connection, '', '', '', '', '');

$dadosCompromisso = $compromisso->buscarPorId($connection, $id);

if (!$dadosCompromisso) {
    die("<p style='color:red;'>Compromisso não encontrado!</p>");
}

$dadosAtualizados = [
    'id' => $id,
    'data_inicio' => $dadosCompromisso->data_inicio,
    'data_fim' => $dadosCompromisso->data_fim,
    'titulo' => $dadosCompromisso->titulo,
    'descricao' => $dadosCompromisso->descricao,
    'cliente' => $dadosCompromisso->cliente
];

// Faz a edição
$resultado = $compromisso->editar($dadosAtualizados);

if (is_array($resultado) && ($resultado['success'] ?? false)) {
    echo '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Compromisso Editado</title>
        <style>
            body { font-family: Arial; background: #f0fff4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
            .alerta-sucesso { background: #28a745; color: white; padding: 20px; border-radius: 8px; text-align: center; }
            .btn-voltar { background: #19692c; color: white; padding: 10px; border-radius: 5px; text-decoration: none; }
            .btn-voltar:hover { background: #145a22; }
        </style>
    </head>
    <body>
        <div class="alerta-sucesso">
            <h2>Agendamento "' . htmlspecialchars($titulo) . '" editado com sucesso!</h2>
            <a href="../templates/meuNegocio.php" class="btn-voltar">Voltar</a>
        </div>
    </body>
    </html>
    ';
} else {
    $erro = htmlspecialchars($resultado['error'] ?? 'Erro ao editar compromisso');
    echo "<p style='color:red;'>$erro</p>";
    echo "<a href='../Views/editarAgendamentos.php?id=$id'>Voltar</a>";
}