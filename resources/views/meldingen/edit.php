<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Aanpassen</title>
    <?php require_once '../components/head.php'; ?>
</head>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen";
    header("Location: " . $base_url . "/login.php?msg=" . $msg);
}
?>
<body>
    <?php

    if (!isset($_GET['id'])) {
        echo "Geef in je aanpaslink op de index.php het id van betreffende item mee achter de URL in je a-element om deze pagina werkend te krijgen na invoer van je vijfstappenplan";
        exit;
    }
    ?>
    <?php
    require_once '../components/header.php'; ?>

    <div class="container">
        <h1>Melding aanpassen</h1>

        <?php
        //Haal het id uit de URL:
        $id = $_GET['id'];

        //1. Haal de verbinding erbij
        //...........
        require_once '../../../config/conn.php';

        //2. Query, vul deze aan met een WHERE zodat je alleen de melding met dit id ophaalt
        //...........
        $query = "SELECT * FROM meldingen WHERE id = :id";

        //3. Van query naar statement
        $statement = $conn->prepare($query);

        //4. Voer de query uit, voeg hier nog de placeholder toe
        $statement->execute([
            //................
            ':id' => $id
        ]);

        //5. Ophalen gegevens, tip: gebruik hier fetch().
        $melding = $statement->fetch(PDO::FETCH_ASSOC);
        ?>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Naam attractie:</label>
                <?php echo $melding['attractie']; ?>
            </div>
            <!-- Zorg dat het type wordt getoond, net als de naam hierboven -->
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input"
                    value="<?php echo $melding['capaciteit']; ?>">
            </div>
            <div class="form-group">
                <label for="prioriteit">Prio:</label>
                <!-- Let op: de checkbox blijft nu altijd uit, pas dit nog aan -->
                <input type="checkbox" name="prioriteit" id="prioriteit" <?php if ($melding['prioriteit'] == 1) {
                                                                                echo 'checked';
                                                                            } ?>>
                <label for="prioriteit">Melding met prioriteit</label>
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <!-- Voeg hieronder nog een value-attribuut toe, zoals bij capaciteit -->
                <input type="text" name="melder" id="melder" class="form-input" value="<?php echo $melding['melder']; ?>">
            </div>
            <div class="form-group">
                <label for="overig">Overige info:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4"><?php echo $melding['overige_info']; ?></textarea>
            </div>

            <input type="submit" value="Melding opslaan">

        </form>

        <button id="delete">Delete</button>
        <div id="deletemodel">
            <div class="model-content">
                <h2>Weet je zeker dat je deze melding wilt verwijderen?</h2>
                <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" value="Melding verwijderen">
                </form>
                <button id="closemodel">nee</button>
            </div>
        </div>
    </div>

</body>

<script>
    document.getElementById('deletemodel').style.display = 'none';
    document.getElementById('delete').addEventListener('click', function() {
        document.getElementById('deletemodel').style.display = 'block';
    });
    document.getElementById('closemodel').addEventListener('click', function() {
        document.getElementById('deletemodel').style.display = 'none';
    });
</script>

</html>