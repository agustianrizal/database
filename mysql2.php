<html>
    <body>
        <form method="post" action="mysql2.php">
        <table width="500" border="0" cellspacing="1" cellpadding="2">
        <tr>
            <td width="100">Nama</td>
            <td><input name="nama" type="text" id="nama"></td>
        </tr>
        <tr>
            <td width="120">Alamat</td>
            <td><input name="alamat" type="text" id="alamat"></td>
        </tr>
        <tr>
            <td width="100">Kampus</td>
            <td><input name="kampus" type="text" id="kampus"></td>
        </tr>
        <tr>
            <td width="110"> </td>
            <td>
                <input name="simpan" type="submit" id="simpan" value="Simpan">
            </td>
        </tr>
        </table>
    </form>
        <?php
            if(isset($_POST['simpan']))
            {
            $servername="localhost";
    $username="root";
    $password="";
    $database="biodata";
    $koneksi=mysql_connect ($servername, $username, $password);

  if ($koneksi) {
    mysql_select_db ($database) or die ("Database Tidak Ditemukan");
     echo "<b> Koneksi Berhasil </b>";
   } else {
     echo "<b> Koneksi Gagal </b>";
   }
             
            if(! get_magic_quotes_gpc() )
            {
               $Nama = addslashes ($_POST['nama']);
               $Alamat = addslashes ($_POST['alamat']);
               $Kampus = addslashes($_POST['kampus']);
               
            }
            else
            {
               $Nama = $_POST ['nama'];
               $Alamat = $_POST ['alamat'];
               $Kampus = $_POST['kampus'];
               }
            
            //Memasukkan data kedalam tabel mahasiswa
            $sql = "INSERT INTO biodata ".
                   "(nama,alamat,kampus) ".
                   "VALUES('$Nama','$Alamat','$Kampus')";
            mysql_select_db('biodata');
            $tambahdata = mysql_query( $sql, $koneksi );
            if(! $tambahdata )
            {
              die('Gagal Tambah Data: ' . mysql_error());
            }
            echo "Berhasil tambah data\n <br>";
            
            //Mengambil data dari tabel mahasiwa
            $sql = "SELECT nama,alamat,kampus FROM biodata";
            mysql_select_db('biodata');
            $hasil = mysql_query($sql);
            
            // Hasil Inputan
            while ( $row = mysql_fetch_assoc($hasil) ) {
                echo "<br>";
                echo "Nama: " . $row["nama"]. " - Alamat: " . $row["alamat"]. " - Kampus: " . $row["kampus"]. "<br>";
            }
            mysql_close($koneksi);
            }
            else
            {
            }
        ?>
    </body>
</html>