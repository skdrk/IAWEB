<?php
    function getConnection() {
        $mysqli = new mysqli("localhost", "phpmyadmin", "kali", "iaweb");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        return $mysqli;
    }