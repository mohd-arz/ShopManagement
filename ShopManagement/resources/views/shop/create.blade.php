<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400&display=swap" rel="stylesheet">
</head>
<style>
        body{
            font-family: 'Figtree', sans-serif;
            background-color :rgb(17 24 39);
            color: rgb(175 ,175,175);
            height:100vh;
            display:flex;
            flex-direction:column;
        }
        .container{
            flex:1;
            display:flex;
            justify-content
            align-items:center;
        }
        .form-group{
            margin: 1rem;
        }
        .form-control,input{
            border:1px solid black;
            width:50vw;
        }
        .alert{
           padding: 0.1rem;
        }
    </style>
<body>
        <h1 class='text-center'>Register As a Shop</h1>
        <div class="container d-flex justify-content-center align-items-center">
        <form action="{{route('sentApproval')}}" method='post' class='form'>
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Shop Name:
                    <input type="text" name='name' class="form-control" >
                     @error('name') <p class='alert alert-danger mt-2'>{{$message}}</p> @enderror
                </label>
            </div>
            <div class="form-group">
                <label for="contactno" class="form-label">Contact Number:
                    <input type="text" name='contactno' class="form-control">
                </label>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email:
                    <input type="email" name='email' class="form-control">
                </label>
            </div>
            <div class="form-group">
                <input type="submit" value='Sent Approval' class='btn btn-primary'>
            </div>
        </form> 
        </div>
</body>
<script>
</script>
</html>