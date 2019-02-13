<div class="container">

<?php
if ($feedback == "succes") {
    echo '<div class="alert alert-success" role="alert">';
    echo '<h4 class="alert-heading">Gelukt!</h4>';
    echo '<p>U bent nu ingelogd</p>';
    echo '<hr>';
    echo '<p class="mb-0">klik <a href="' . URL . 'ToDoList/lists" class="alert-link">hier</a> om uw lijstjes te zien.</p>';
    echo '</div>';
} else if ($feedback == "oeps"){
    echo '<div class="alert alert-danger" role="alert">';
    echo '<h4 class="alert-heading">Mislukt!</h4>';
    echo '<p>Er is iets fout gegaan, controleer uw gebruikersnaam en wachtwoord</p>';
    echo '<hr>';
    echo '<p class="mb-0">klik <a href="' . URL . 'Login/index" class="alert-link">hier</a> om het nog een keer te proberen.</p>';
    echo '</div>';
} else if ($feedback == "aangemaakt"){
    echo '<div class="alert alert-info" role="alert">';
    echo '<h4 class="alert-heading">Gelukt!</h4>';
    echo '<p>Uw gebruikers account is aangemaakt!</p>';
    echo '<hr>';
    echo '<p class="mb-0">klik <a href="' . URL . 'Login/index" class="alert-link">hier</a> om in te loggen.</p>';
    echo '</div>';
}
?>
</div>
