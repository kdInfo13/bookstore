<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Review Email</title>
</head>
<body>
    <h2>Review details</h2>
    <p>Book Name: {{$review['book_name']}}</p>
    <p>Rating: {{$review['reviews']['rating']}}</p>
    <p>Review: {{$review['reviews']['review']}}</p>
    <p>Posted By: {{$review['user']['name']}}</p>
    <p>Posted At: {{$review['reviews']['created_at']}}</p>
</body>
</html>