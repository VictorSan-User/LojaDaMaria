<?php

include 'ControllerAgendamentos.php';
include 'Database.php';

$connection = Database::connect();

$agendamentos = Compromisso::listarPassados($connection);
header('Content-Type: application/json');
echo json_encode($agendamentos);

$connection->close();