<?php

session_destroy();
unset($_SESSION['_USER_']);

header('Location:' . LINK . 'auth');