<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers: *');
include_once '../../data/conexao.php';
$json = file_get_contents("php://input");
$dados = json_decode($json, true);
if($dados){
    $sql = "INSERT INTO noticia 
    (titulo, descricao, conteudo, imagem)
    VALUES (:titulo, :descricao, :conteudo, :imagem)";
    $cad = $dbc->prepare($sql);
    $cad->bindParam(':titulo', $dados['titulo'], PDO::PARAM_STR);
    $cad->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
    $cad->bindParam(':conteudo', $dados['conteudo'], PDO::PARAM_STR);
    $cad->bindParam(':imagem', $dados['imagem'], PDO::PARAM_STR);
    $cad->execute();
    $response = [
        "erro" => false,
        "message" => "Notícia cadastrado com sucesso"
    ];
} else {
    $response = [
        "erro" => true,
        "message" => "Dados não cadastrados com sucesso"
    ];
}

http_response_code(200);
echo json_encode($dados);
?>
