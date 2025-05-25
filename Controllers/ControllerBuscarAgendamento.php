<?php
include 'ControllerAgendamentos.php';
include 'Database.php';

$connection = Database::connect();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'ID inválido']);
    exit;
}

$agendamento = Compromisso::buscarPorId($connection, $id);

if ($agendamento) {
    header('Content-Type: application/json');
    echo json_encode($agendamento);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Agendamento não encontrado']);
}

$connection->close();
