<?php
include("koneksi.php");
if(isset($_GET["id"])){
    $id = $_GET["id"];
    mysqli_query($conn, "DELETE FROM buku WHERE id_buku = $id");
    if (mysqli_affected_rows($conn) > 0) {
        header("Location: buku.php");
    }
}