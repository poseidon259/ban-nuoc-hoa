<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/bootstrap.min.css">
</head>
<style>
    table,
    th,
    td {
        border: 1px solid black;
    }

    .button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 5px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border: 1px solid #8ecae6;
    }

    .button1 {
        background-color: #8ecae6;
        color: white;
    }

    .button1:hover {
        background-color: white;
        color: black;
       
    }
</style>

<body>
    <table width="200px">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{$d->id}}</td>
            <td>{{$d->name}}</td>
            <td><button class="button button1">View</button></td>
        </tr>
        @endforeach
    </table>
    {{$data->links()}}
</body>

</html>