<!DOCTYPE html>
<html>
<head>
	<title>Liste des participants</title>
	<style>
		table {
			border-collapse: collapse;
			width: 50%;
			margin: 50px auto;
		}
		th, td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: left;
		}
		th {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body>

<?php
// Connexion à la base de données
$db = new mysqli('localhost', 'root', '', 'simplon');

// Vérification de la connexion
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];

// Insertion des données dans la base de données
$sql = "INSERT INTO participants (nom, prenom, telephone, email) VALUES ('$nom', '$prenom', '$telephone', '$email')";
if ($db->query($sql) === TRUE) {
    echo "Les données ont été enregistrées avec succès.<br>";
} else {
    echo "Erreur: " . $sql . "<br>" . $db->error;
}

// Récupération des données des participants
$sql = "SELECT * FROM participants";
$result = $db->query($sql);

// Affichage des données dans un tableau HTML
if ($result->num_rows > 0) {
    echo "<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nom"] . "</td><td>" . $row["prenom"] . "</td><td>" . $row["telephone"] . "</td><td>" . $row["email"] . "</td></tr>";
    }
    echo "</tbody>
    </table>";
} else {
    echo "Aucun participant enregistré.";
}

// Fermeture de la connexion à la base de données
$db->close();
?>

</body>
</html>
