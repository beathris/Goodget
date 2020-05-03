<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-8 col-md-8">
                        <img src="{{url($produk->foto)}}" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <h4>
                            {{$produk->nama_barang}}</h4>
                            <p>Tgl Masuk : {{$produk->tgl_masuk}}</p>
                            <p>Harga : {{$produk->harga}}</p>
                            <p>Harga Jual : {{$produk->harga_jual}}</p>
                            <p>Stok : {{$produk->stok}}</p>
                            <p>Warna : {{$produk->warna}}</p>
                            <p>Kategori : {{$produk->nama_kategori}}</p>
                        </div>
                    </div>
                    <h4>Deskripsi : </h4>
                     <p>{{$produk->spesifikasi}}</p>
                </div>
                 </center>
            </div>
        </div>
    </div>
</div>

