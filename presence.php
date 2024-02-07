<?php
	$conn = new mysqli("localhost", "root", "", "register_dtb");

	if (isset($_POST['adh']) AND isset($_POST['presence'])) {
		$sql = "INSERT INTO attendance (id, m5Sept23)
				VALUES (?, ?)
				ON DUPLICATE KEY UPDATE m5Sept23 = VALUES(m5Sept23);";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ss', str_replace('"', '', $_POST['adh']), $_POST['presence']);
		$stmt->execute();

		if (isset($_POST['proba_adh'])) {
			$sql = "INSERT INTO probaadh (adh, proba_adh)
					VALUES (?, ?)
					ON DUPLICATE KEY UPDATE proba_adh = VALUES(proba_adh);";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('ss', str_replace('"', '', $_POST['adh']), $_POST['proba_adh']);
			$stmt->execute();
		}
	}
?>  	