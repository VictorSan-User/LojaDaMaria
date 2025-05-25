<?php
include 'ControllerAgendamentos.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $erros = [];

    // validacoes do serverside
    if(empty($_POST['data_inicial'])){
        $erros[] = 'Data Inicial Obrigatoria';
    }
    if(empty($_POST['data_final'])){
        $erros[] = 'Data Final Obrigatoria';
    }
    if(empty($_POST['titulo'])){
        $erros[] = 'Titulo Obrigatorio';
    }
    if(empty($_POST['descricao'])){
        $erros[] = 'Descricao Obrigatoria';
    }
    if(empty($_POST['cliente'])){
        $erros[] = 'Cliente Obrigatoria';
    }

    if ($_POST['data_final'] < $_POST['data_inicial']) {
        $erros[] = 'A Data Final deve ser apoós à Data Inicial.';
    }

    $data_inicio = $_POST['data_inicial'];
    $data_fim = $_POST['data_final'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $cliente = $_POST['cliente'];

    // $compromisso = new Compromisso();

    if($erros){
        foreach($erros as $erro){
            echo "<p style='color:red;'>$erro</p>";
        }
    } else {
        echo "<p style='color:green;'>Dados validados com sucesso!</p>";

        $host = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'tb_agendamentos';

        $connection = new mysqli($host, $usuario, $senha, $banco);

        if($conn->connect_error){
            die("Falha na conexão: " . $connection->connect_error);
        }

        //utilizei VALUES (?, ?, ?, ?, ?) pra evitar sqlinjection
        $stmt = $connection->prepare("INSERT INTO agendamentos (data_inicial, data_final, titulo, descricao, cliente) VALUES (?, ?, ?, ?, ?)");

        if($stmt){
            //5 S. PRA 5 VARIAVEIS DE TIPO STRING
            $stmt->bind_param("sssss", $data_inicio, $data_fim, $titulo, $descricao, $cliente);

            if($stmt->execute()){
                echo "<p style='color:green;'>Agendamento salvo com sucesso!</p>";
            } else {
                echo "<p style='color:red;'>Erro ao salvar: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p style='color:red;'>Erro na preparação da query: " . $conn->error . "</p>";
        }

        $conn->close();
    }

}else{
    echo "Acesso Negado";
    return;
}
