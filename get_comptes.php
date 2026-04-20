<?php
header('Content-Type: application/json; charset=utf-8');

$fichier = 'comptes.json';

if (file_exists($fichier)) {
    $comptes = json_decode(file_get_contents($fichier), true);
    echo json_encode($comptes ?: []);
} else {
    echo json_encode([]);
}
