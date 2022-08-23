<?php
$mdp = 'admin';
$hash = password_hash($mdp, PASSWORD_DEFAULT);
echo ('mot de passe crypté : ' . $hash);
