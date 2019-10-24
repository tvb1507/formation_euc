<?php
echo 'MD5 Hash: ' . md5('password')."\n";

// C'est OK
echo 'SHA1 Hash: ' . sha1('password')."\n";

// C'est mieux
echo 'Bcrypt Hash: ' . password_hash('password', PASSWORD_BCRYPT, ['cost'=>12])."\n";

// C'est encore mieux
echo 'Argon2i Hash: ' . password_hash('password', PASSWORD_ARGON2I)."\n";

// <3
echo 'Argon2id Hash: ' . password_hash('password', PASSWORD_ARGON2ID);
