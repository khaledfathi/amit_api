<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>API DOC</h1>
    <hr>
    <a href="{{url(route('schema'))}}">Schema </a>
    <hr><br><br>
    <div>
        <h3>Users</h3>
        <p>GET | http://ah.khaledfathi.com/api/user/ | get all users</p>
        <p>POST | http://ah.khaledfathi.com/api/user/ | create user</p>
        <p>GET | http://ah.khaledfathi.com/api/user/{id} | get user by id </p>
        <p>DELETE | http://ah.khaledfathi.com/api/user/{id} | delete user by id</p>
        <p>POST | http://ah.khaledfathi.com/api/user/update/{id} | update user by id</p>
        <br>
        <h3>Category</h3>
        <p>GET | http://ah.khaledfathi.com/api/category/ | get all Categories</p>
        <p>POST | http://ah.khaledfathi.com/api/category/ | create Category</p>
        <p>GET | http://ah.khaledfathi.com/api/category/{id} | get Category by id </p>
        <p>DELETE | http://ah.khaledfathi.com/api/category/{id} | delete Category by id</p>
        <p>POST | http://ah.khaledfathi.com/api/category/update/{id} | update Category by id</p>
        <br>
        <h3>Product</h3>
        <p>GET | http://ah.khaledfathi.com/api/Product/ | get all Products</p>
        <p>POST | http://ah.khaledfathi.com/api/Product/ | create Product</p>
        <p>GET | http://ah.khaledfathi.com/api/Product/{id} | get Product by id </p>
        <p>DELETE | http://ah.khaledfathi.com/api/Product/{id} | delete Product by id</p>
        <p>POST | http://ah.khaledfathi.com/api/Product/update/{id} | update Product by id</p>
        <p>GET | http://ah.khaledfathi.com/api/filter-by/category/{category_id} | get all product in category {category_id}</p>
        <p>GET | http://ah.khaledfathi.com/api/Product/filter-by/max-price/{max_price} | get product with  price less or equal {max_price}  </p>
    </div>    
</body>
</html>