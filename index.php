<?php

$id = $_GET['id'];
$nome = $_GET['nome'];
$user = $_GET['user'];
$email = $_GET['email'];
$senha = $_GET['senha'];

$db = new PDO('sqlite:player1.php');

$stmt = $db->prepare('SELECT * FROM jogador');
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$line = '';

foreach ($result as $item) {
    $line .= '<tr>';
    $line .= '<td>'. $item['id'] .'</td>';
    $line .= '<td>'. $item['nome'] .'</td>';
    $line .= '<td>'. $item['user'] .'</td>';
    $line .= '<td>'. $item['email'] .'</td>';
    $line .= '<td>'. $item['data_cadastro'] .'</td>';
    $line .= '</tr>';
}

$template = file_get_contents('index.html');
$template = str_replace('<!--AQUI_VEM_AS_LINHAS-->', $line, $template);
echo $template;