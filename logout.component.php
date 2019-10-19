<?php
// logout.component
// session_start(); 10,838.99 pearlinn321
if (isset($_SESSION['customerName']) || isset($_SESSION['userRole'])) {
    session_destroy();
    header("Location: http://localhost/Site/jnj_bi_project/");
}

