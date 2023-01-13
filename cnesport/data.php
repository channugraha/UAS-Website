<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <title>Report Print</title>
        <!-- datatable style -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <!-- bootstrap 4 css  -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <!-- css tambahan  -->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    </head>
    
    <body>
    
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <!-- membuat tabel -->
                    <table id="table_id" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>No HP</th>
                                <th>Divisi</th>
                                <th>Roles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //melakukan koneksi ke database
                                $koneksi        = mysqli_connect("localhost", "root", "", "dbcnesport");
    
                                //mengambil data mahasiswa
                                $select         = mysqli_query($koneksi, "select * from tb_member");
    
                                //membuat variabel index penomoran
                                $no = 1;
    
                                //melakukan perualangan data dengan while
                                while($data= mysqli_fetch_array($select)){
                            ?>
                            <tr>
                                <!-- menampilkan data -->
                                <td><?=$no++;?></td>
                                <td><?=$data['nik']?></td>
                                <td><?=$data['nama']?></td>
                                <td><?=$data['jenis_kelamin']?></td>
                                <td><?=$data['alamat']?></td>
                                <td><?=$data['no_hp']?></td>
                                <td><?=$data['divisi']?></td>
                                <td><?=$data['roles']?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    
    
        </div>
    </html>
    