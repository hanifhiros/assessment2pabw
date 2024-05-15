<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AJAX dan Tabel</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 20px;
            color: #333;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            border-collapse: collapse; 
            width: 80%; 
            margin-left: auto; 
            margin-right: auto;
        }

        th, td {
            padding: 10px; 
            border: 1px solid #ddd; 
            text-align: center;
        }

        th {
            background-color: #f2f2f2; 
            color: #333; 
        }

        tr:hover {
            background-color: #f1f1f1; 
        }
    </style>
</head>
<body>
    <h1>Data Pengguna</h1>
    <button id="loadData">Muat Data Pengguna</button> <!-- Tombol untuk memicu AJAX -->
    
    <table id="userTable"> 
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data dari AJAX akan dimasukkan di sini -->
        </tbody>
    </table>

    <script>
    $(document).ready(function() {
        $('#loadData').click(function() {
            $.ajax({
                url: 'get.php', // Skrip PHP untuk mendapatkan data
                type: 'GET',
                dataType: 'json', // Respons diharapkan dalam format JSON
                success: function(data) { 
                    $('#userTable tbody').empty(); 

                    data.forEach(function(masyarakat_desa) { 
                        $('#userTable tbody').append(
                            '<tr>' +
                            '<td>' + masyarakat_desa.masyarakat_id+ '</td>' +
                            '<td>' + masyarakat_desa.nama + '</td>' +
                            '<td>' + masyarakat_desa.username + '</td>' +
                            '<td>' + masyarakat_desa.email + '</td>' +
                            '<td><button class="deleteUser" data-id="' + masyarakat_desa.masyarakat_id + '">Hapus</button></td>' + 
                            '</tr>'
                        );
                    });

                     
                      $('.deleteUser').click(function() {
                        var userID = $(this).data('id'); 
                        if (confirm("Apakah Anda yakin ingin menghapus pengguna ini?")) { 
                            $.ajax({
                                url: 'delete_user.php', 
                                type: 'GET', 
                                data: { id: userID },
                                success: function(response) {
                                    alert('Pengguna berhasil dihapus.');
                                    
                                    $('#loadData').click();
                                },
                                error: function(xhr, status, error) { 
                                    alert('Gagal menghapus pengguna: ' + error);
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) { // Jika permintaan gagal
                    alert('Gagal memuat data: ' + error);
                }
            });
        });
    });
    </script>
</body>
</html>
