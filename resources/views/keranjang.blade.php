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
@foreach($keranjang as $k)

    <div class="card mb-3" style="max-width:700px" id="item">
        <div class="row no-gutters">
            {{--                <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
            @csrf
            <div class="col-md-4">
                <img src="{{url($k->foto)}}" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body item">
                    <h5 class="card-title" id="name"> {{$k->nama_barang}}</h5>
                    <p class="card-text"><label>Harga : </label>
                        <span id="price">{{$k->harga_jual}}</span></p>
                    <button type="button" class="plus">+</button>
                    <span id="qty" name="qty">{{$k->jumlah}}</span>
                    <button type="button" class="min">-</button>
                    <input type="hidden" id="product_id" name="product_id" class="form-control"
                           value="{{$k->produk_id}}">
                    <input type="hidden" id="user_id" name="user_id" class="form-control"
                           value="{{$k->user_id}}">
                </div>
            </div>
        </div>
    </div>
@endforeach
<button class="btn btn-warning float-right" id="checkout" type="submit"> Checkout</button>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script>
    $(".plus").on("click", function () {

        let button = $(this);
        let qty = $(button).parent().find("#qty");
        qty.text((Number(qty.text()) + 1));
        console.log($(button).parent().find("#qty").text())

    });
    $(".min").on("click", function () {

        let button = $(this);
        let qty = $(button).parent().find("#qty");
        qty.text((Number(qty.text()) - 1));
        console.log($(button).parent().find("#qty").text())

    });

    $("#checkout").on("click", function () {
        let bodyRequest = {
            items: []
        };

        $(".item").each(function (index, e) {
            let item = {
                "product_id": $(this).find("#product_id").val(),
                "name": $(this).find("#name").text(),
                "price": $(this).find("#price").text(),
                "qty": $(this).find("#qty").text(),
                "user_id": $(this).find("#user_id").val(),
            }
            bodyRequest.items.push(item);
        })

        $.ajax({
            type: 'POST',
            url: '/keranjang/nota',
            data: {
                '_token': $('input[name=_token]').val(),
                'items': bodyRequest
            },
            success: function (data) {
                if(data.redirect) {
                    window.location.href = data.redirect;
                }
                console.log(data);
            }
        });
    });
</script>
</body>
</html>
