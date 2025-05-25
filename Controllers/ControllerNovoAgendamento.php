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
        echo "<p style='color:green;'>Dados validados com sucesso!</p>";

        $connection = Database::connect();

        $stmt = $connection->prepare("INSERT INTO TB_AGENDAMENTOS (data_inicial, data_final, titulo, descricao, cliente) VALUES (?, ?, ?, ?, ?)");

        if($stmt){
            $stmt->bind_param("sssss", $data_inicio, $data_fim, $titulo, $descricao, $cliente);

            if($stmt->execute()){
                echo "<p style='color:green;'>Agendamento salvo com sucesso!</p>";
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
