<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $data_inicio = (isset($_POST['data_inicial']) ?? '');
    $data_fim = (isset($_POST['data_final']) ?? '');
    $titulo = (isset($_POST['titulo']) ?? '');
    $descricao = (isset($_POST['descricao']) ?? '');
    $cliente = (isset($_POST['cliente']) ?? '');

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


}else{
    echo "Acesso Negado";
    return;
}
