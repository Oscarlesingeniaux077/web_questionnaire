<?php
header('Content-Type: application/json; charset=utf-8');

$fichier = 'comptes.json';
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['index'])) {
    echo json_encode(["success" => false, "message" => "Index manquant."]);
    exit;
}

if (!file_exists($fichier)) {
    echo json_encode(["success" => false, "message" => "Aucun fichier trouvé."]);
    exit;
}

$comptes = json_decode(file_get_contents($fichier), true);

if (!isset($comptes[$data['index']])) {
    echo json_encode(["success" => false, "message" => "Compte introuvable."]);
    exit;
}

array_splice($comptes, $data['index'], 1);
file_put_contents($fichier, json_encode($comptes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(["success" => true]);
