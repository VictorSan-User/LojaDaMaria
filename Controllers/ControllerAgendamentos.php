<?php

class Compromisso{
    public $data_inicio;
    public $data_fim;
    public $titulo;
    public $descricao;
    public $cliente;

    public $connect;

    public function __construct($connect, $cliente, $descricao, $titulo, $data_fim, $data_inicio)
    {
        $this->connect = $connect;
        $this->cliente = $cliente;
        $this->descricao = $descricao;
        $this->titulo = $titulo;
        $this->data_fim = $data_fim;
        $this->data_inicio = $data_inicio;
    }

    public function salvar(){
        $dados = $this->connect->prepare("INSERT INTO tb_agendamentos(data_inicial, data_final, titulo, descricao, cliente) VALUES(?, ?, ?, ?, ?)");

        if($dados){
            $dados->bind_param("sssss", $this->data_inicio, $this->data_fim, $this->titulo, $this->descricao, $this->cliente);

            if($dados->execute()){
                return ['success' => true, 'message' => 'Agendamento salvo!'];
            }else{
                return "Erro ao salvar ". $dados->error;
            }
        }
    }
    public function editar($id){
        $editContent = $this->connect->prepare("UPDATE tb_agendamentos SET data_inicial=?, data_final=?, titulo=?, descricao=?, cliente=? WHERE id=?");
        if($editContent){
            $editContent->bind_param("sssssi", $this->data_inicio, $this->data_fim, $this->titulo, $this->descricao, $this->cliente, $id);
            if($editContent->execute()){
                return ['success' => true, 'message' => 'Agendamento Atualizado!'];
            } else {
                return "Erro ao atualizar: " . $editContent->error;
            }
        } else {
            return "Erro na preparação: " . $this->connect->error;
        }
    }
    public function excluir($id) {
        $stmt = $this->connect->prepare("DELETE FROM tb_agendamentos WHERE id = ?");
        if($stmt){
            $stmt->bind_param("i", $id);
            if($stmt->execute()){
                return ['success' => true, 'message' => 'Compromisso Excluido!'];

            } else {
                return "Erro ao excluir: " . $stmt->error;
            }
        } else {
            return "Erro na preparação: " . $this->connect->error;
        }
    }
    public static function listarFuturos($connect) {
    $hoje = date('Y-m-d');
    $stmt = $connect->prepare("SELECT * FROM tb_agendamentos WHERE data_inicial >= ?");
    $stmt->bind_param("s", $hoje);
    $stmt->execute();
    $result = $stmt->get_result();

    $agendamentos = [];

    while ($row = $result->fetch_assoc()) {
        $agendamentos[] = $row;
    }
    return $agendamentos;
    }

    public static function listarPassados($connect) {
        $hoje = date('Y-m-d');
        $date = $connect->prepare("SELECT * FROM tb_agendamentos WHERE data_final < ? ORDER BY data_inicial DESC");
        $date->bind_param("s", $hoje);
        $date->execute();
        $result = $date->get_result();

        $agendamentos = [];
        while ($row = $result->fetch_assoc()) {
            $agendamentos[] = $row;
        }
        return $agendamentos;
    }
    public static function buscarPorId($connect, $id) {
    $stmt = $connect->prepare("SELECT * FROM tb_agendamentos WHERE id= :id");

    if (!$stmt) return null;

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Compromisso(
                $connect,
                $row['cliente'],
                $row['descricao'],
                $row['titulo'],
                $row['data_final'],
                $row['data_inicial']
            );
        }

    return null;
    }


}