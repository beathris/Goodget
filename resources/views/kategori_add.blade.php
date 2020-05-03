<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Kategori</title>


</head>
<body>
<div class="container">
    <center>
    <form action="{{url('/admin/kategori/add/save')}}" method="POST">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <h2>Masukan Data Kategori</h2>
    <div class="form-group">
   <input type="text" name="id" class="form-control" placeholder="Masukan ID">
    </div>
    <br>
    <div class="form-group">
    <input type="text" name="nama_kategori" class="form-control" placeholder="Masukan Kategori">
    </div>
    <br>
    <input type="submit" value="Simpan" class="btn btn-success"/>
    </form>

    </center>
</div>
</body>
</html>
