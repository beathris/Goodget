<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('assets/library/dropzone-5.7.0/dropzone.min.css')}}">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Masukan Data Produk</h2>
    <form action="{{url('/admin/add/post/save')}}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <input type="text" name="id" class="form-control" placeholder="Masukan id">
        </div>
        <div class="form-group">
            <input type="text" name="nama_barang" class="form-control" placeholder="Masukan Nama">
        </div>
        <br>
        <div class="form-group">
            <input type="date" name="tgl_masuk" class="form-control" placeholder="Masukan Tanggal Masuk">
        </div>
        <br>
        <div class="form-group">
            <input type="text" name="harga" class="form-control" placeholder="Masukan Harga">
        </div>
        <br>
        <div class="form-group">
            <input type="text" name="harga_jual" class="form-control" placeholder="Masukan Harga Jual">
        </div>
        <br>
        <div class="form-group">
            <input type="text" name="stok" class="form-control" placeholder="Masukan Stok">
        </div>
        <br>
        <div class="form-group">
            <input type="text" name="warna" class="form-control" placeholder="Masukan Warna">
        </div>
        <br>
        <div class="form-group">
        <input type="text" name="kategori_id" class="form-control" placeholder="Masukan Id Kategori">
        </div>
        <br>
        <div class="form-group">
    <textarea class="form-control" id="exampleFormControlTextarea1" name="spesifikasi" rows="3"
              placeholder="Spesifikasi">
    </textarea>
        </div>
        <div class="form-group">
            <input type="file" class="form-control" name="file" multiple="multiple">
        </div>
        <input type="submit" value="Simpan" class="btn btn-success"/>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="{{url('assets/library/dropzone-5.7.0/dropzone.min.js')}}"></script>
</body>
</html>
