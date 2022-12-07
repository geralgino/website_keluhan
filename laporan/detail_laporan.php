<?php 
 $id = $_GET["id"];


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="/style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <style>
        font-face {
            font-family: '';
        }

        .logo {
            width: 80%;
        }

        .text-sub-hero {
            font-size: 28px;
        }

        .content {
            margin-top: 3em;
        }
    </style>

    <script type="text/javascript">

        var id = <?= $id; ?>

        $(document).ready(function () {

            getDataById(id)
            getUser()
            getKategori()
        })

        var user = []
        var kategori = []

        async function getDataById(id) {
            let response = await fetch("https://kkiz0wxz.directus.app/items/laporan/"+id);
            response = await response.json();
            var htm = ``
            

            $.each(response, function (key, val) {
                var first_name = ``
                var last_name = ``
                var nama_kategori = ``
                

                $.each(user, function (kl, vl) {
                  
                    if (val.id_user == vl.id_user) {
                        first_name = vl.first_name
                        last_name = vl.last_name
                    }
                
                })

                $.each(kategori, function(lk,vl){
                    // console.log(vl);
                    if(val.id_kategori == vl.id_kategori){
                        nama_kategori = vl.nama_kategori

                        console.log(vl.nama_kategori)
                    
                        
                        
                    }
                     var htm= `
                                <div class="card-body">
                                    <h5 class="card-title">${val.judul_laporan}</h5>
                                    <img src="https://kkiz0wxz.directus.app/assets/${val.foto}" alt="" height="350" width="350">
                                    <p class="card-text">Kategori : ${vl.nama_kategori} </p>
                                    <p class="card-text">Pelapor : ${first_name}</p>
                                    <p class="card-text">Isi Laporan : ${val.isi_laporan}</p>
                                    <p class="card-text">Sifat Laporan : ${val.sifat_laporan} </p>
                                    <p class="card-text">Tanggal Laporan : ${val.tanggal_laporan}</p>
                                    <p class="card-text">Solusi : </p>
                                    <button type="submit" class="btn btn-primary">Tambah Solusi</button>
                                </div>
                        
                                `
                    console.log(htm)
                        $('#dt-api').html(htm)
                })             
            })        
            
        }
        function getUser() {
            $.getJSON('https://kkiz0wxz.directus.app/users', function (r) {
                $.each(r.data, function (k, v) {
                    user.push({ id_user: v.id, first_name: v.first_name, last_name: v.last_name })
                })
            })
        }
        function getKategori(){
            $.getJSON('https://kkiz0wxz.directus.app/items/kategori', function (r) {
                $.each(r.data, function (k, v) {
                    kategori.push({ id_kategori: v.id, nama_kategori: v.nama_kategori })
                })
            })
        }

        



    </script>
</head>

<body>
    <!-- Navbar -->
    <div id="navbar"></div>
    <!-- Navbar -->

    <div class="container" style="margin-bottom: 100px;">
        <div class="row">
            <div class="col" id="dt-api">

               

            </div>


        </div>

    </div>

    <!-- Footer -->
    <div id="footer"></div>
    <!-- Footer -->

</body>

</html>

<script>
    $(function () {
        $("#navbar").load("/navbar.html");
        $("#footer").load("/footer.html");
    });
</script>