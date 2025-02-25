<?php

$action = $_POST['action'];
if ($action == "create") {


    //Variabelen vullen
    $attractie = $_POST['attractie'];
    if (empty($attractie)) {
        $errors[] = "Vul een attractie naam in.";
    }
    $type = $_POST['type'];
    if (empty($type)) {
        $errors[] = "Vul een type in.";
    }
    $capaciteit = $_POST['capaciteit'];
    if (!is_numeric($capaciteit)) {
        $errors[] = "Vul een capaciteit in.";
    }
    if (isset($_POST['prioriteit'])) {
        $prioriteit = 1;
    } else {
        $prioriteit = 0;
    }
    $melder = $_POST['melder'];
    if (empty($melder)) {
        $errors[] = "Vul een melder in.";
    }
    $overig = $_POST['overig'];

    if (isset($errors)) {
        var_dump($errors);
        die();
    }

    echo $attractie . " / " . $capaciteit . " / " . $melder;

    //1. Verbinding
    require_once '../../../config/conn.php';

    //2. Query
    $query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info) VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overig)";



    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute

    $statement->execute([
        ":attractie" => $attractie,
        ":type" => $type,
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overig" => $overig
    ]);

    header("Location: " . $base_url . "/resources/views/meldingen/index.php?msg=Melding opgeslagen");
} else if ($action == "update") {
    require_once '../../../config/conn.php';
    $id = $_POST['id'];
    $attractie = $_POST['attractie'];
    $type = $_POST['type'];
    $capaciteit = $_POST['capaciteit'];
    $prioriteit = $_POST['prioriteit'];
    $melder = $_POST['melder'];
    $overig = $_POST['overig'];
    $query = "UPDATE meldingen SET attractie = :attractie, type = :type, capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, overige_info = :overig WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":attractie" => $attractie,
        ":type" => $type,
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overig" => $overig,
        ":id" => $id
    ]);
    header("Location: " . $base_url . "/resources/views/meldingen/index.php?msg=Melding opgeslagen");
} else if ($action == "delete") {
}
