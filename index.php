<?php

require_once('connect.php');

$sql = "SELECT * FROM prepare_statement";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php - Prepare Statement</title>
</head>

<body>
    <div>
        <?php if (isset($_SESSION['message_success'])) : ?>
            <div id="message-success">
                <p><?= $_SESSION['message_success']; ?></p>
            </div>
            <?php
            unset($_SESSION['message_success']);
            ?>
        <?php endif; ?>

        <div id="message-request"></div>

        <a href="tambahdata.php">Tambah Data</a>

        <h1>Data</h1>

        <div>
            <ul id="all-data">
                <?php if ($result->num_rows > 0) : ?>
                    <?php
                    $no = 1;
                    ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <li>
                            <?= $no++ ?> : <strong><?= $row['name']; ?></strong> (<strong><?= $row['profession']; ?></strong>) - <a href="editdata.php?id=<?= $row['id']; ?>">Edit</a> | <button type="button" data-table="<?= $row['id']; ?>" id="hapusdata">Hapus</button>
                        </li>
                    <?php endwhile; ?>
                <?php else : ?>
                    <li>
                        Data Kosong!
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('ul').on('click', '#hapusdata', function() {
                var data = $(this).attr('data-table')

                $.ajax({
                    url: '/php_preparestatement/request.php',
                    type: 'POST',
                    data: {
                        'id': data
                    },
                    success: function(response) {
                        if (response['message'] == 'success') {
                            $('#message-success').empty()
                            $('#all-data').empty()

                            $('#message-request').html('<p>Data Berhasil Dihapus!</p>')

                            if (response['data'].length > 0) {
                                $.each(response['data'], function(key, value) {
                                    $('#all-data').append(`
                                <li>
                                    ` + (key + 1) + ` : <strong>` + value['name'] + `</strong> (<strong>` + value['profession'] + `</strong>) - <a href="editdata.php?id=` + value['id'] + `">Edit</a> | <button type="button" data-table="` + value['id'] + `" id="hapusdata">Hapus</button>
                                </li>
                                `)
                                })
                            } else {
                                $('#all-data').append(`
                                <li>Data Kosong!</li>
                                `);
                            }
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>