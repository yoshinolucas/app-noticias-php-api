<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
include_once '../data/conexao.php';

$response = "";
$sql = "SELECT * FROM noticia";
$result = $dbc->prepare($sql);
$result->execute();

if(($result) AND ($result->rowCount() != 0)){
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $noticias['records'][$id] = [
            "id" => $id,
            "titulo" => $titulo,
            "descricao" => $descricao,
            "conteudo" => $conteudo,
            "imagem" => $imagem
        ];
    }
    $response = [
        "erro" => false,
        "noticia" => $noticias
    ];
} else {
    $response = [
        "erro" => true,
        "message" => "Notícia não encontrada!"
    ];
}
http_response_code(200);
echo json_encode($response);
?>
    
