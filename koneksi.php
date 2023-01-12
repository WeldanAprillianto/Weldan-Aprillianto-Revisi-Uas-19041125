<?php

// Connect to the database server
$conn = mysqli_connect('localhost', 'root', '', 'data_kumpi');

// Check if the connection was successful
if (!$conn) {
    // If the connection failed, display an error message
    die('Error connecting to MySQL: ' . mysqli_connect_error());
}