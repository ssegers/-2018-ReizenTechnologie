<div>
    <p><b>Beste {{ $name }}, je kan je passwoord aanpassen via:
            <a href="<?php echo "http://" . env("DB_HOST") . "/password/resetpassword/"; ?>{{$token}}">Klik hier</a></b></p>
    <p>Pas op deze link is maar 30 minuten geldig</p>
</div>