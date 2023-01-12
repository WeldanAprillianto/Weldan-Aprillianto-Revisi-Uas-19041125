<script>
<?php
include("koneksi.php");
if(isset($_GET["id"])){
    $id = $_GET["id"];
    mysqli_query($conn, "UPDATE peminjaman SET dikembalikan = 1 WHERE id_peminjaman = $id");
    if (mysqli_affected_rows($conn) > 0) {
        $result = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_peminjaman = $id AND tgl_pengembalian < DATE(NOW())");
        if (mysqli_num_rows($result) > 0) {
            echo "alert('Denda Rp. 7.000');";
        }
        // header("Location: peminjaman.php");
    }
    echo "window.location.href = 'peminjaman.php';";
}
?>
</script>