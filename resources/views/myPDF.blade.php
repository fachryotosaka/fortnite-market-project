<!DOCTYPE html>
<html>
<head>
    <title>lexa.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

    <img src="{{ public_path('img/icon.png') }}" alt="">

    <p>{{ $date }}</p>
    <p>Data is a record of a collection of facts. In everyday usage, data means a statement that is taken for granted. This statement is the result of measurement or observation of a variable whose form can be in the form of numbers, words, or images.</p>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
        </tr>
        @foreach($users as $hero)
        <tr>
            <th scope="row">{{ $hero->id }}</th>
            <td>{{ $hero->name }}</td>
            <td>{{ $hero->Category->name }}</td>
            <td>{{ $hero->price }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>
