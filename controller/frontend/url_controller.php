<?php
$url = $_SESSION['company_id'] . '___' . str_replace('_', '', SITE_URL) . '/';
$url_encrpt = $security->encrypt($url, key);
