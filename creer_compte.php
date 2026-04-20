<?php
header('Content-Type: application/json; charset=utf-8');

$fichier = 'comptes.json';

if (!file_exists($fichier)) {
    file_put_contents($fichier, json_encode([]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (
    !isset($data['nom'], $data['prenom'], $data['age'], $data['email'], $data['password'])
) {
    echo json_encode(["success" => false, "message" => "Données incomplètes"]);
    exit;
}

$nom = trim($data['nom']);
$prenom = trim($data['prenom']);
$age = trim($data['age']);
$email = trim($data['email']);
$password = trim($data['password']);

if ($nom === "" || $prenom === "" || $age === "" || $email === "" || $password === "") {
    echo json_encode(["success" => false, "message" => "Tous les champs sont obligatoires"]);
    exit;
}

$comptes = json_decode(file_get_contents($fichier), true) ?: [];

foreach ($comptes as $compte) {
    if (strtolower($compte['email']) === strtolower($email)) {
        echo json_encode(["success" => false, "message" => "Cette adresse mail existe déjà."]);
        exit;
    }
}

$comptes[] = [
    "nom" => $nom,
    "prenom" => $prenom,
    "age" => $age,
    "email" => $email,
    "password" => $password
];

file_put_contents($fichier, json_encode($comptes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(["success" => true, "message" => "Compte créé avec succès"]);
