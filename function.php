<?php
session_start();
//Membuat koneksi kedata base
$conn = mysqli_connect("localhost","root","","sparepart");

//Menambah Barang Baru
if(isset($_POST['addnewbarang'])){
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST ['deskripsi'];
    $stock = $_POST ['stock'];
    $lokasi = $_POST ['lokasi'];

    $addtotable = mysqli_query($conn,"insert into stock(idbarang, namabarang, deskripsi, stock,lokasi) values('$idbarang','$namabarang', '$deskripsi', '$stock','$lokasi')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header ('location:index.php');
    }

}

//Menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang= '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

$addtomasuk = mysqli_query($conn,"insert into masuk (idbarang,keterangan,qty) values('$barangnya','$penerima','$qty')");
$updatestockmasuk = mysqli_query($conn,"update stock set stock = '$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");
if($addtomasuk&&$updatestockmasuk){
    header('location:masuk.php');
} else {
    echo 'Gagal';
    header ('location:masuk.php');
}
}

//Menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $keterangan = $_POST['keterangan'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang= '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

$addtokeluar = mysqli_query($conn,"insert into keluar (idbarang, penerima, qty,keterangan) values('$barangnya','$penerima','$qty','$keterangan')");
$updatestockmasuk = mysqli_query($conn,"update stock set stock = '$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");
if($addtokeluar&&$updatestockmasuk){
    header('location:keluar.php');
} else {
    echo 'Gagal';
    header ('location:keluar.php');
}
}

//Update Info Barang

if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
    $lokasi = $_POST['lokasi'];
 
    $update = mysqli_query($conn, "update stock set namabarang= '$namabarang', deskripsi='$deskripsi', stock='$stock', lokasi='$lokasi' where idbarang= '$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header ('location:index.php');
    }

}

//Menghapus Barang Dari Stock
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");

    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header ('location:index.php');
    }

}





//Menghapus Barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock-$qty;


    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header ('location:masuk.php');
    }
}

//Menghapus Barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock+$qty;


    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header ('location:keluar.php');
    }
}

?>

    