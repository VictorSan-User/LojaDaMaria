<?php

include 'ControllerAgendamentos.php';
include 'Database.php';

$connection = Database::connect();

$agendamentos = Compromisso::listarPassados($connection);
