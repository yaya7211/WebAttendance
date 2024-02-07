<?php
	$conn = new mysqli("localhost", "root", "", "register_dtb");

	$sql = "INSERT INTO non_adherents (civilite, nom, prenom, mail) VALUES (?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssss", $_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['mail']);

	$stmt->execute();
    $inserted_id = $conn->insert_id;

    $sql = "INSERT INTO attendance (id, m25Sept23) VALUES (?, 1) ON DUPLICATE KEY UPDATE m25Sept23 = VALUES(m25Sept23);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $inserted_id);
    $stmt->execute();

    if (isset($_POST['adhesion'])) {
	    $sql = "INSERT INTO probaadh (adh, proba_adh) VALUES (?, ?) ON DUPLICATE KEY UPDATE proba_adh = VALUES(proba_adh);";
	    $stmt = $conn->prepare($sql);
	    $stmt->bind_param('ss', $inserted_id, $_POST['adhesion']);
	    $stmt->execute();
	}

    header("Location: index.html");
?>
