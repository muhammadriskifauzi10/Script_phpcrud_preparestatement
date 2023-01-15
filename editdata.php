<?php

require_once('connect.php');

$id = $_GET['id'];

$sql = "SELECT * FROM prepare_statement WHERE id='$id'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

if (isset($_POST['updatedata'])) {
    $sqleditdata = $conn->prepare("UPDATE prepare_statement SET name=? , profession=? WHERE id=?");

    $nama = htmlspecialchars($_POST['name']);
    $profesi = htmlspecialchars($_POST['profession']);

    $sqleditdata->bind_param("ssi", $nama, $profesi, $_POST['idhidden']);

    if ($sqleditdata->execute()) {
        $success_message = "Data Berhasil Diperbarui!";
        $_SESSION['message_success'] = $success_message;
        header('location: index.php');
    }

    $sqleditdata->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>

<body>
    <div>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <input type="hidden" name="idhidden" value="<?= $id ?>">
            <div>
                <label>Nama:</label>
                <input type="text" name="name" autocomplete="off" value="<?= $data['name']; ?>">
            </div>
            <div>
                <label>Profesi:</label>
                <select name="profession">
                    <option value="Mahasiswa" <?= ($data['profession'] == 'Mahasiswa') ? 'selected' : '' ?>>Mahasiswa</option>
                    <option value="Pekerja" <?= ($data['profession'] == 'Pekerja') ? 'selected' : '' ?>>Pekerja</option>
                </select>
            </div>
            <div>
                <button type="submit" name="updatedata">Simpan</button>
            </div>
        </form>
    </div>
</body>

</html>