<?php

/*
Vamos construir os cabeçalho para o trabalho com  a api
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=utf-8");

#Esse cabeçalho define o método de envio com PUT, ou seja, como atualizar
header("Access-Control-Allow-Methods:PUT");

#Define o tempo de espera da api. Neste caso é 1 minuto.
header("Access-Control-Max-Age:3600");

include_once "../../config/database.php";

include_once "../../domain/usuario.php";

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

/*
O cliente irá enviar os dados no formato json. Porém nós precisamos dos dados
 no formato php para atualizar em banco de dados. Para realizar essa conversão
 iremos usar o comando json_decode. Assim que o cliente enviar os dados, estes são
 lidos pela entrada php: e seu conteúdo é capturado e convertido para o formato
 php.
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os campos estão com dados.

if(!empty($data->senha) && !empty($data->id)){

    $usuario->senha = $data->senha;
    $usuario->id = $data->id;

    if($usuario->alterarSenha()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"Senha do usuário alterada com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível alterar a senha."));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa passar todos os dados para alterar a senha"));
}
?>