<?php

class pedido{


    public $id;
    public $id_cliente;
    public $data_pedido;
    
    
    
    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os usuário cadastrados no banco
     de dados. Essa função retorna uma lista com todos os dados.
    */
    public function listar(){
        #Seleciona todos os campos da tabela pedido
        $query = "select * from pedido";

        /*
        Foi criada a variável stmt(Statment -> Sentença) para guardar a preparação da consulta
        select que será executada posteriomente.
        */
        $stmt = $this->conexao->prepare($query);

        #execução da consulta e guarda de dados na variável stmt
        $stmt->execute();

        #retorna os dados do usuário a camada data.
        return $stmt;
    }

    /*
    Função para o sistema de login do usuário
    */
   

    /*
    Função para cadastrar os usuário no banco de dados
    */
    public function cadastro(){
        $query = "insert into pedido set id_cliente=:idc";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizada 2 funções para tratar os dados que estão vindo do usuário
        para a api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar -> retira as aspas e os 2 pontos que vem do formato 
        json para cadastrar em banco.
        */
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        
        
        $stmt->bindParam(":idc",$this->id_cliente);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }        
    }

    public function atualizar(){
        $query = "udpate into pedido set id_cliente=:idc where id=:i";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizada 2 funções para tratar os dados que estão vindo do usuário
        para a api.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar -> retira as aspas e os 2 pontos que vem do formato 
        json para cadastrar em banco.
        */
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        
        $stmt->bindParam(":idc",$this->id_cliente);
        $stmt->bindParam(":i",$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from pedido where id=?";

        $stmt=$this->conexao->prepare($query);

        $stmt->bindParam(1,$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}

?>