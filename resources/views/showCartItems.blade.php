
@extends('layouts.webBottom')
@section('web')
    <div class="main-showCartItems">
        <div class="main-sidebar" >
        </div>
        <div>
            <div class="main-content-showCartItems">
                <div class="table-wrapper-responsive">
                    <table class="table table-responsive table-hover" id="cart-table" summary="Shopping cart">
                        <caption>SHOPPINGCART</caption>
                        <thead class="thead-light">
                        <h4>SHOPPINGCART</h4>
                        <tr>
                            <th class="goods-page-image">Image</th>
                            <th class="goods-page-description">Description</th>
                            <th class="goods-page-ref-no"></th>
                            <th class="goods-page-quantity">Quantity</th>
                            <th class="goods-page-price">Price</th>
                            <th class="goods-page-total" colspan="2"></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderItems1 as $O)
                            @if($O->imagePath)
                                @if($O->totalPrice)
                                    <tr id="orderItem{{$O->product->id}}">
                                        <td>
                                            <a href="{{action('ProductController@show', $id = $O->product->id)}}" style="margin:1px ">
                                            <img style="width: 100px" class="img-responsive" src="{{ url('storage/images/productImages/'.$O->imagePath) }}" alt="" title="" />
                                            </a>
                                        </td>
                                        <td>
                                            {{$O->name}}
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <div class="product-quantity">
                                                <form class="editQuantity" id="editQuantity{{$O->id}}" data-id="{{$O->product->id}}" method="POST" type="hidden">
                                                    {{csrf_field()}}
                                                    {{ method_field('PATCH')}}
                                                    <input name="_method" value="PATCH" type="hidden">
                                                    <input class="form-control input-sm" id="product-quantity{{$O->product->id}}" type="text" value={{$O->amount}}>
                                                </form>
                                            </div>
                                        </td>
                                         <!--
                                               <td>
                                                   <div class="product-quantity">
                                                       <form method="POST" action="{{action('OrderItemController@update',$O->product_id)}}">
                                                           {{csrf_field()}}
                                                    <input name="_method" type="hidden" value="PATCH">
                                                    <input type="number" class="form-control" name="amount">
                                                    <button type="submit" class="btn btn-success" style="width: 70px">Change</button>
                                                </form>
                                            </div>
                                        </td>
                                        -->
                                        <td>
                                            <strong> <div id="orderItemTotalPrice{{$O->product->id}}"><span>$</span>{{$O->totalPrice}}</div></strong>
                                        </td>
                                        <td class="del-goods-col">
                                            <button class="btn btn-danger delete"  name="_method" id="delete{{$O->product->id}}" data-id="{{$O->product->id}}" data-token="{{ csrf_token() }}" >remove via Javascript</button>
                                            <form action="{{action('OrderItemController@destroy', $id = $O->product->id)}}" method="post">
                                                {{csrf_field()}}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit" style="margin:1px;width: 168px ">Remove via PHP</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="main-content-checkoutForm">
                    <div>
                        <strong><h3>Billing Address</h3></strong>
                        <div>
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input class="form-control input-sm" type="text" id="fname" name="firstname" placeholder="{{session('name')}}">
                        </div>
                        <div>
                            <label for="fname"><i class="fa fa-envelope"></i> Email</label>
                            <input class="form-control input-sm" type="text" id="fname" name="firstname" placeholder="{{session('email')}}">
                        </div>
                        <div>
                            <label for="fname"><i class="fa fa-address-card-o"></i> Address</label>
                            <input class="form-control input-sm" type="text" id="fname" name="firstname" placeholder="">
                        </div>
                        <div>
                            <label for="fname"><i class="fa fa-institution"></i> city</label>
                            <input class="form-control input-sm" type="text" id="fname" name="firstname" placeholder="">
                        </div>
                        <div style="padding-top: 20px">
                            <button class="btn btn-success">Continue to check out</button>
                        </div>
                    </div>
                    <div>
                        <strong><h3>Payment</h3></strong>
                        <div>
                            <div>
                                <label for="fname">Accepted Cards</label>
                                <div class="icon-container">
                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                                </div>
                            </div>
                        </div>
                        <div style="padding-top: 12px">
                            <label for="cname">Name on Card</label>
                            <input class="form-control input-sm" type="text" id="cname" name="cardname" placeholder="{{session('name')}}">
                        </div>
                        <div>
                            <label for="ccnum">Credit card number</label>
                            <input class="form-control input-sm" type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                        </div>
                        <div>
                            <label for="expmonth">Exp Month</label>
                            <input class="form-control input-sm"type="text" id="expmonth" name="expmonth" placeholder="September">
                        </div>

                    </div>
                </div>
                <div>
                    <div class="card" style="width: 200px">
                        <div class="card-body">
                            <h4 class="card-title">
                                Order Summary
                            </h4>
                            @foreach($orderItems1 as $O)
                                @if($O->imagePath)
                                    @if($O->totalPrice)
                                        <div class="card-text">
                                            <span>{{$O->product->name}} : ${{$O->totalPrice}}</span>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                            <div class="card-text" id="totalPrice1">
                                <strong><span>$</span>{{$cart->totalPrice}}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $('.editQuantity').submit(function(event)// edit product quantity
            {
                event.preventDefault();
                var params = $(this).data();
                var productQuantity = $('#product-quantity'+params.id).val();// chuyen qua id *********************************
                if(productQuantity)
                console.log(params.id);
                {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(productQuantity);
                    $.ajax(
                    {
                        method: "GET",
                        url: "/order_items/" + params.id +"/edit",
                        data: { quantity: productQuantity },
                        success: function (data)
                        {

                            var price = "<span>$</span>"+data.orderItemsPrice;
                            var totalPrice = " <strong><span>$</span>"+data.totalPrice+"</strong>";
                            $('#totalPrice1').html(totalPrice);
                            $('#orderItemTotalPrice'+params.id).html(price);
                        },
                        error: function (data)
                        {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function (key, value)
                            {
                            });
                        }

                    })
                }
            });
            $('.delete').click(function(e){
                event.preventDefault();
                var _this = $(this);
                var params = _this.data();
                var token = $(this).data('token');
                console.log(params.id);
                console.log(token);
                var price0 = "<strong><span>$</span>{{$cart->totalPrice}}</strong>";
                $.ajax( {
                    type : 'post',
                    url  : "/order_items/"+params.id,
                    data : {_method: 'delete', _token :token},
                    success: function (data)
                    {
                        console.log('delete');
                        console.log(data.totalPrice);
                        var totalPrice = " <strong><span>$</span>"+data.totalPrice+"</strong>";
                        console.log('wet');
                        $('#totalPrice1').html(totalPrice);
                    }
                } )
                $( "#orderItem"+params.id ).remove();
               // $('#orderItemTotalPrice'+params.id).html(price0);

            });
        });
        var slideIndex = 0;
        carousel();
        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > x.length) {slideIndex = 1}
            x[slideIndex-1].style.display = "block";
            setTimeout(carousel, 2000); // Change image every 2 seconds
        }
    </script>
@endsection
@extends('layouts.webTop')
