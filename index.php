<!DOCTYPE html>
<html>
<head>
    <title>Giriş Sayfası</title>
    <style type="text/css">
        body {
            font-family: Verdana, Geneva, sans-serif;
            background-color: #4f4f4f; /* Arka plan rengi */
            color: #ffffff; /* Genel metin rengi */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .buton {
            background-color: #ffffff; /* Buton arka plan rengi */
            width: 80px;
            border: 1px solid #004d4d; /* Buton kenarlık rengi */
            border-radius: 150px;
            height: 30px;
            margin: 5px;
        }
        .buton:hover {
            background-color: #cdc1c5; /* Buton  arka plan rengi */
            color: #ffffff; /* Buton  yazı rengi */
            font-weight: bold;
            font-style: italic;
        }
        .textbox {
            border: 2px solid;
            border-radius: 4px;
            box-shadow: 3px 3px 3px #000;
        }
        fieldset {
            background-color: #708090;
            width: 200px; /* Genişlik ayarlandı */
            margin-left: auto; /* Ortalamak için */
            margin-right: auto; /* Ortalamak için */
            margin-top: 10%;
            padding: 20px;
            border: 1px solid;
            border-radius: 10px;
            box-shadow: 3px 3px 4px #000;
            position: relative; /* Konumlandırma için */
        }
        .error-message {
            position: absolute;
            top: 10px; /* Sayfa üstünde pozisyonlandır */
            left: 50%; /* Orta hizalama */
            transform: translateX(-50%); /* Yatayda ortala */
            color: red;
            font-weight: bold;
            text-align: center;
            display: none; /* Başlangıçta gizli */
        }
        .error-message.show {
            display: block; /* Hata olduğunda göster */
        }
        .security-code {
            font-family: Arial, sans-serif;
            font-size: 20px;
            color: #333;
            text-align: center; /* Güvenlik kodunu ortala */
            display: block; /* Div içinde kullanmak için */
            margin: 10px auto; /* Dikey ve yatay ortalama */
        }
    </style>
</head>
<body>
<form method="post">
    <div class="error-message" id="error-message">GİRİLEN BİLGİLER HATALI</div>
    <fieldset>
    
        <b>Ad</b><br><br>
        <input class="textbox" type="text" name="ad"><br><br>

        <b>Şifre</b><br><br>
        <input class="textbox" type="password" name="sifre"><br><br>

        <div class="security-code">
            <p><strong>Güvenlik Kodu:</strong></p>
            <?php 
            $code = substr(md5(microtime()), rand(0, 26), 6); 
            echo $code;
            ?>
            <input type="hidden" name="gkod_hidden" value="<?php echo $code; ?>">
        </div>

        <br>
        <b>Güvenlik Kodunu Giriniz</b><br>
        <input class="textbox" type="text" name="gkod"><br><br>

        <input class="buton" type="submit" name="giris" value="Giriş Yap">
        
        <?php
        session_start(); 
        if (isset($_POST['giris'])) {
            $ad = $_POST['ad'];
            $sifre = $_POST['sifre'];
            $gkod = $_POST['gkod'];
            $dogru_gkod = $_POST['gkod_hidden'];

            if ($ad == "user" && $sifre == "password" && $gkod == $dogru_gkod) {
                $_SESSION['adi'] = $ad;
                $_SESSION['sifre'] = $sifre;
                header("Location: main.php");
                exit; // Yönlendirme sonrası işlemi durdurmak için exit kullanıyoruz.
            } else {
                echo '<script type="text/javascript">document.getElementById("error-message").classList.add("show");</script>';
            }
        }
        ?>
    </fieldset>
</form>
</body>
</html>
