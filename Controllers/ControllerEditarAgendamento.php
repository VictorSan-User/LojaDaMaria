<?php
include 'ControllerAgendamentos.php';
include 'Database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Acesso Negado";
    return;
}

$id = $_POST['id'] ?? null;
if (!$id || !is_numeric($id)) {
    die("<p style='color:red;'>ID do agendamento inválido!</p>");
}

$connection = Database::connect();

$query = $connection->prepare("SELECT data_inicial, data_final, titulo, descricao, cliente FROM tb_agendamentos WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    die("<p style='color:red;'>Agendamento não encontrado!</p>");
}

$atual = $result->fetch_assoc();
$query->close();

$data_inicio = !empty($_POST['data_inicial'])  ? $_POST['data_inicial']  : $atual['data_inicial'];
$data_fim    = !empty($_POST['data_final'])    ? $_POST['data_final']    : $atual['data_final'];
$titulo      = !empty($_POST['titulo'])        ? $_POST['titulo']        : $atual['titulo'];
$descricao   = !empty($_POST['descricao'])     ? $_POST['descricao']     : $atual['descricao'];
$cliente     = !empty($_POST['cliente'])       ? $_POST['cliente']       : $atual['cliente'];

if (strtotime($data_fim) < strtotime($data_inicio)) {
    die("<p style='color:red;'>A Data Final deve ser após a Data Inicial.</p>");
}

$update = $connection->prepare("
    UPDATE tb_agendamentos
    SET data_inicial = ?, data_final = ?, titulo = ?, descricao = ?, cliente = ?
    WHERE id = ?
");
$update->bind_param(
    "sssssi",
    $data_inicio,
    $data_fim,
    $titulo,
    $descricao,
    $cliente,
    $id
);

if ($update->execute()) {
    echo "<p style='color:green;'>Agendamento atualizado com sucesso!</p>";
} else {
    echo "<p style='color:red;'>Erro ao atualizar: " . $update->error . "</p>";
}

$update->close();
$connection->close();
?>
