<?php
include 'ControllerAgendamentos.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $erros = [];

    if(empty($_POST['id'])){
        $erros[] = 'ID do agendamento é obrigatório!';
    }
    if(empty($_POST['data_inicial'])){
        $erros[] = 'Data Inicial Obrigatória';
    }
    if(empty($_POST['data_final'])){
        $erros[] = 'Data Final Obrigatória';
    }
    if(empty($_POST['titulo'])){
        $erros[] = 'Título Obrigatório';
    }
    if(empty($_POST['descricao'])){
        $erros[] = 'Descrição Obrigatória';
    }
    if(empty($_POST['cliente'])){
        $erros[] = 'Cliente Obrigatório';
    }

    if ($_POST['data_final'] < $_POST['data_inicial']) {
        $erros[] = 'A Data Final deve ser após à Data Inicial.';
    }

    $id = $_POST['id'];
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
        $host = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'tb_agendamentos';

        $connection = new mysqli($host, $usuario, $senha, $banco);

        if($connection->connect_error){
            die("Falha na conexão: " . $connection->connect_error);
        }

        $compromisso = new Compromisso($connection, $cliente, $descricao, $titulo, $data_fim, $data_inicio);

        $resultado = $compromisso->editar($id);

        if(is_array($resultado) && $resultado['success']){
            echo "<p style='color:green;'>" . $resultado['message'] . "</p>";
        } else {
            echo "<p style='color:red;'>$resultado</p>";
        }

        $connection->close();
    }

} else {
    echo "Acesso Negado";
    return;
}
?>
