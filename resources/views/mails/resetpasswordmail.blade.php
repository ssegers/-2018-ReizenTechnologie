<div>
    <p><b>Beste {{ $name }}, je kan je passwoord aanpassen via:
            <a href="<?php echo "http://" . $_SERVER["SERVER_NAME"] . "/password/resetpassword/"; ?>{{$token}}">Klik hier</a></b></p>
    <p>Pas op deze link is maar 30 minuten geldig</p>
</div>