<?php require_once __DIR__ . '/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen";
    header("Location: " . $base_url . "/login.php?msg=" . $msg);
}
?>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <!-- <div style="height: 300px; background: #ededed; display: flex; justify-content: center; align-items: center; color: #666666;">(hier komen de storingsmeldingen)</div> -->

        <?php

        require_once "../../../config/conn.php";

        $query  = "SELECT * FROM meldingen";
        $statement = $conn->prepare($query);
        $statement->execute();
        $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);

        // foreach ($meldingen as $melding) {
        //     echo "<p>" . $melding['attractie'] . "</p>";
        // }
        ?>

        <table>
            <tr>
                <th>Attractie</th>
                <th>Type</th>
                <th>capaciteit</th>
                <th>prioriteit</th>
                <th>melder</th>
                <th>gemeld op</th>
                <th>overige info</th>
                <th>aanpassen</th>
            </tr>
            <?php foreach ($meldingen as $melding) : ?>
                <tr>
                    <td><?php echo $melding['attractie']; ?></td>
                    <td><?php echo $melding['type']; ?></td>
                    <td><?php echo $melding['capaciteit']; ?></td>
                    <td><?php echo $melding['prioriteit']; ?></td>
                    <td><?php echo $melding['melder']; ?></td>
                    <td><?php echo $melding['gemeld_op']; ?></td>
                    <td><?php echo $melding['overige_info']; ?></td>
                    <td><a href="edit.php?id=<?php echo $melding['id']; ?>">Aanpassen</a></td>
                </tr>
            <?php endforeach; ?>

        </table>
        <!-- <?php foreach ($meldingen as $melding) : ?>
            <p><?php echo $melding['attractie']; ?>, Type: <?php echo $melding['type']; ?></p>
        <?php endforeach; ?> -->
        <!-- <pre><?php print_r($meldingen); ?></pre> -->
    </div>

</body>

</html>