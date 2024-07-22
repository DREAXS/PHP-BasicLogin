<?php
session_start();

// Oturum kontrolü
if (!isset($_SESSION['adi'])) {
    header("Location: index.php");
    exit; 
}

// Profil güncelleme işlemi
if (isset($_POST['guncelle'])) {
    $_SESSION['adi'] = htmlspecialchars($_POST['adi']);
    $_SESSION['sifre'] = htmlspecialchars($_POST['sifre']);

    // Profil fotoğrafı yükleme işlemleri
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
        $avatar_tmp = $_FILES['avatar']['tmp_name'];
        $avatar_name = basename($_FILES['avatar']['name']);
        $avatar_dir = 'uploads/' . $avatar_name;

        // Profil fotoğrafını uploads dizinine taşı
        if (move_uploaded_file($avatar_tmp, $avatar_dir)) {
            $_SESSION['avatar'] = $avatar_dir;
        } else {
            $mesaj = "Profil fotoğrafı yüklenirken hata oluştu.";
        }
    }

    $mesaj = "Profil güncellendi.";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Düzenle</title>
    <style>
        body {
            font-family: Verdana, Geneva, sans-serif;
            background-color: #4f4f4f;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            max-width: 400px;
            margin: auto;
            padding: 20px;
        }
        .buton {
            background-color: #ffffff;
            color: black;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }
        .buton:hover {
            background-color: #cdc1c5;
            color: black; /* Buton  yazı rengi */
            font-weight: bold;
            font-style: italic;
        }
        .textbox {
            border: 2px solid;
            border-radius: 4px;
            box-shadow: 3px 3px 3px #000;
            padding: 8px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box; /* Kutu modelini düzgün hale getir */
        }
        fieldset {
            background-color: #708090;
            border: none;
            border-radius: 10px;
            box-shadow: 3px 3px 4px #000;
        }
        legend {
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .logout-icon {
            vertical-align: middle;
            margin-right: 5px;
        }
        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <fieldset>
            <legend>Profil Düzenle</legend>
            <?php if (isset($mesaj)) { echo "<p>$mesaj</p>"; } ?>
            <form method="post" enctype="multipart/form-data">
                <label for="adi">Ad:</label><br>
                <input class="textbox" type="text" id="adi" name="adi" value="<?php echo htmlspecialchars($_SESSION['adi']); ?>"><br><br>

                <label for="sifre">Şifre:</label><br>
                <input class="textbox" type="password" id="sifre" name="sifre" value="<?php echo htmlspecialchars($_SESSION['sifre']); ?>"><br><br>

                <label for="avatar">Profil Fotoğrafı:</label><br>
                <input type="file" id="avatar" name="avatar"><br><br>

                <?php if (isset($_SESSION['avatar'])): ?>
                    <img src="<?php echo $_SESSION['avatar']; ?>" alt="Profil Fotoğrafı" class="avatar"><br><br>
                <?php endif; ?>

                <input class="buton" type="submit" value="Bilgileri Güncelle" name="guncelle">
                <a href="index.php" class="buton">Ana Sayfa</a>
            </form>
        </fieldset>
    </div>
</body>
</html>
