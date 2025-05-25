<?php
include 'ControllerAgendamentos.php';
include 'Database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $erros = [];

    // validações do server-side
    if(empty($_POST['data_inicial'])) $erros[] = 'Data Inicial Obrigatória';
    if(empty($_POST['data_final'])) $erros[] = 'Data Final Obrigatória';
    if(empty($_POST['titulo'])) $erros[] = 'Título Obrigatório';
    if(empty($_POST['descricao'])) $erros[] = 'Descrição Obrigatória';
    if(empty($_POST['cliente'])) $erros[] = 'Cliente Obrigatório';

    if ($_POST['data_final'] < $_POST['data_inicial']) {
        $erros[] = 'A Data Final deve ser após à Data Inicial.';
    }

    $data_inicio = $_POST['data_inicial'];
    $data_fim = $_POST['data_final'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $cliente = $_POST['cliente'];

    if($erros){
        foreach($erros as $erro){
            echo "<p style='color:red;'>$erro</p>";
        }
    } else {

        $connection = Database::connect();

        $stmt = $connection->prepare("INSERT INTO tb_agendamentos (data_inicial, data_final, titulo, descricao, cliente) VALUES (?, ?, ?, ?, ?)");

        if($stmt){
            $stmt->bind_param("sssss", $data_inicio, $data_fim, $titulo, $descricao, $cliente);

            if($stmt->execute()){
                echo '
                    <!DOCTYPE html>
                    <html lang="pt-br">
                    <head>
                        <meta charset="UTF-8" />
                        <title>Compromisso Criado</title>
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
                                background-color: #28a745; /* Verde vivo */
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
                            <h2>Novo Compromisso "' . htmlspecialchars($titulo) . '" criado com sucesso!</h2>
                            <a href="../templates/meuNegocio.php" class="btn-voltar">Voltar</a>
                        </div>
                    </body>
                    </html>
                    ';
            } else {
                echo "<p style='color:red;'>Erro ao salvar: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p style='color:red;'>Erro na preparação da query: " . $connection->error . "</p>";
        }

        $connection->close();
    }

} else {
    echo "Acesso Negado";
    return;
}
?>
