<?php

include 'ControllerAgendamentos.php';
include 'Database.php';

$connection = Database::connect();

$agendamentos = Compromisso::listarFuturos($connection);
header('Content-Type: application/json');
echo json_encode($agendamentos);

$connection->close();