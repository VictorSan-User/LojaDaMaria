<?php
include 'ControllerAgendamentos.php';
include 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erros = [];

    // Validar ID
    if (empty($_POST['id'])) {
        $erros[] = 'ID do agendamento é obrigatório!';
    } elseif (!is_numeric($_POST['id'])) {
        $erros[] = 'ID inválido!';
    }

    if ($erros) {
        foreach ($erros as $erro) {
            echo "<p style='color:red;'>$erro</p>";
        }
        exit;
    }

    $id = (int)$_POST['id'];

    $connection = Database::connect();

    $connection = new mysqli($host, $usuario, $senha, $banco);

    if ($connection->connect_error) {
        die("<p style='color:red;'>Falha na conexão: " . $connection->connect_error . "</p>");
    }

    $compromisso = new Compromisso($connection, '', '', '', '', '');

    $resultado = $compromisso->excluir($id);

    if (is_array($resultado) && $resultado['success']) {
        echo "<p style='color:green;'>" . $resultado['message'] . "</p>";
    } else {
        echo "<p style='color:red;'>$resultado</p>";
    }

    $connection->close();

} else {
    echo "<p style='color:red;'>Acesso Negado</p>";
    exit;
}
?>
