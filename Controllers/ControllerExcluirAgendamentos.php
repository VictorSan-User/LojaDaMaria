<?php
include 'ControllerAgendamentos.php';
include 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $erros = [];

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

    $connection = Database::connect();
    $id = $_POST['id'];

    $stmt = $connection->prepare("SELECT titulo FROM tb_agendamentos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($titulo);
    $stmt->fetch();
    $stmt->close();

    if (empty($titulo)) {
        die("<p style='color:red;'>Agendamento não encontrado!</p>");
    }

    $compromisso = new Compromisso($connection, '', '', '', '', '');
    $resultado = $compromisso->excluir($id);

    if (is_array($resultado) && $resultado['success']) {
        echo '
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8" />
            <title>Compromisso Excluído</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0fff4;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .alerta-sucesso {
                    background-color: #28a745;
                    color: white;
                    padding: 20px 30px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px #1e7e34;
                    text-align: center;
                    max-width: 400px;
                }
                .alerta-sucesso h2 {
                    margin-top: 0;
                    margin-bottom: 15px;
                }
                .btn-voltar {
                    background-color: #19692c;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    cursor: pointer;
                    text-decoration: none;
                    display: inline-block;
                    font-weight: bold;
                }
                .btn-voltar:hover {
                    background-color: #145a22;
                }
            </style>
        </head>
        <body>
            <div class="alerta-sucesso">
                <h2>Agendamento "' . htmlspecialchars($titulo) . '" excluído com sucesso!</h2>
                <a href="../templates/meuNegocio.php" class="btn-voltar">Voltar</a>
            </div>
        </body>
        </html>
        ';
    } else {
        echo "<p style='color:red;'>$resultado</p>";
    }

    $connection->close();
} else {
    echo "<p style='color:red;'>Acesso Negado</p>";
    exit;
}
?>
