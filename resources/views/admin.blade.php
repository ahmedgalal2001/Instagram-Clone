<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Welcome To Admin Dashboard</h1>
    <div class="container">
        <div>
            <table border="2px">
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User ID</th>
                </tr>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->id }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <table border="2px">
            <tr>
                <th>Post Caption</th>
                <th>Post Owner</th>
            </tr>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->caption }}</td>
                    <td>{{ $post->user_id }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <table border="2px">
            <tr>
                <th>Comment Content</th>
                <th>Comment Owner</th>
            </tr>
            <tbody>
                @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->caption }}</td>
                    <td>{{ $comment->user_id }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

<style>
    .container{
        display: flex;
        justify-content: space-evenly
    }
</style>