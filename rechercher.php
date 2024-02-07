<?php
	$conn = new mysqli("localhost", "root", "", "register_dtb");

	$sql = "SELECT adh, civilite, nom, prenom, statut
	            FROM adherents
	            WHERE
	                adh LIKE ? OR
	                CIVILITE LIKE ? OR
	                NOM LIKE ? OR
	                PRENOM LIKE ?";

	$stmt = $conn->prepare($sql);
	  
	$searchTerm = '%' . $_POST['input'] . '%';
	$stmt->bind_param("ssss", 
	        $searchTerm, $searchTerm, $searchTerm, $searchTerm);
	    
	$stmt->execute();


	    $result = $stmt->get_result();
    
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    echo json_encode($data);
    
    $stmt->close();
    $conn->close();
?>
