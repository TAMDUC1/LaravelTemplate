<!doctype html>
<html lang="{{ app()->getLocale()}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LaravelTemplate</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body>
        <nav class="clearfix" style="background-color: #cac8c6" role="navigation">
            <form method="post" action="{{route('logout')}}">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger float-right" >Log out</button>
            </form>
        </nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"> <a href="{{route('profile1')}}">Profile</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Admin index
            </li>
        </ol>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                     admin Index
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admin as $A)
                        <tr id="admin{{$A->id}}">
                            <td>{{$id=$A->id}}</td>
                            <td>{{$name=$A->name}}</td>
                            <td>{{$email=$A->email}}</td>
                            <td><a href="{{action('AdminController@edit', $id=$A->id)}}" class="btn btn-warning">Edit</a></td>
                            <td>
                                <form action="{{action('AdminController@destroy', $id=$A->id)}}" method="post">
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            <td>
                                <button class="btn btn-primary delete" id="delete{{$id}}" data-id="{{$id}}" data-token="{{ csrf_token() }}">
                                    Delete Jquery
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    {{$admin->links()}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="footer">footer</div>
        <script type="text/javascript">
            $('.delete').click(function (event) {
                var _this = $(this);
                var params = _this.data();
                console.log(params.id);
                var token = $(this).data('token');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "post",
                    url: "/admins/" + params.id,
                    data: {_method: 'delete', _token :token},
                    success: function (data) {
                        console.log(params.id);
                        $( "#admin"+params.id ).remove();

                        //  _this.prev().text(data.like);//hien thi like
                    },
                    error: function (data) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (key, value) {
                            $('#' + key).parent().addClass('error');
                        });
                    }
                });
            });
        </script>
    </body>
</html>
