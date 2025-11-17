<?php
$plaintext_password = 'admin123';
$hashed_password = password_hash($plaintext_password, PASSWORD_BCRYPT);

echo "Hashed Password: " . $hashed_password;
?>
