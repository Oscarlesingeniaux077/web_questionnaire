<?php
header("Content-Type: application/json");

$fichier = "comptes.json";

if (!file_exists($fichier)) {
    echo json_encode([]);
    exit;
}

$contenu = file_get_contents($fichier);

if ($contenu === false || trim($contenu) === "") {
    echo json_encode([]);
    exit;
}

echo $contenu;
?>
