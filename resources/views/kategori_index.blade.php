<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="kategori">
    <center><h1>Admin-Kategori</h1></center>
    <br>
    <br>
    <nav class="navbar navbar-light bg-light">

        <a class="btn btn-info" href="/admin/kategori/add">Add New</a>
        <form action="/admin/kategori" method="GET">
            <input class="form-control mr-sm-3" type="search" placeholder="Cari Berdasarkan Kategori"
                   aria-label="Search" name="cari">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            @foreach ($kategori as $k)
                <tbody>
                <tr>
                    <td>{{$k->id}}</td>
                    <td>{{$k->nama_kategori}}</td>
                    <td>
                        <a type="button" class="btn btn-primary" href="/admin/kategori/edit/{{$k->id}}">Edit</a>
                        <a type="button" class="btn btn-danger" href="/admin/kategori/delete/{{$k->id}}">Delete</a>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </nav>
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
</body>
</html>
