<?php

require_once('connect.php');

if (isset($_POST['simpandata'])) {
    $sql = $conn->prepare("INSERT INTO prepare_statement (name,profession) VALUES (?, ?)");

    $nama = htmlspecialchars($_POST['name']);
    $profesi = htmlspecialchars($_POST['profession']);

    $sql->bind_param("ss", $nama, $profesi);

    if ($sql->execute()) {
        $success_message = "Data Berhasil Ditambahkan!";
        $_SESSION['message_success'] = $success_message;

        header('location: index.php');
    } 
    
    $sql->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <div>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div>
                <label>Nama:</label>
                <input type="text" name="name" autocomplete="off" autofocus>
            </div>
            <div>
                <label>Profesi:</label>
                <select name="profession">
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Pekerja">Pekerja</option>
                </select>
            </div>
            <div>
                <button type="submit" name="simpandata">Simpan</button>
            </div>
        </form>
    </div>
</body>

</html>