<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/paginate.css')}}" type="text/css">
  </head> 
</head>
<body class="bg-dark text-white">
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom text-white">
      <a href="/1" class="d-flex align-items-center text-white text-decoration-none">
        <span class="fs-4">MonoDigital task</span>
      </a>
      <nav class="d-inline-flex mt-2 ms-md-3">
        <a class="me-3 py-2 text-white text-decoration-none" href="/allCars"> All Cars on Parking</a>
        <a class="me-3 py-2 text-white text-decoration-none" href="/addUserPage"> Add User</a>
        <a class="me-3 py-2 text-white text-decoration-none" href="/addCarPage">Add new car</a>
      </nav>
    </div>

<div class="container">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>