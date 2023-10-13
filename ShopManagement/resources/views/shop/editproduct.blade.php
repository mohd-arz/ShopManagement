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
        <h1 class='text-center'>Edit Product</h1>
        <div class="container d-flex justify-content-center align-items-center">
        <form action="{{route('editProduct',$product->id)}}" method='post' class='form'>
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Product Name:
                    <input type="text" name='name' class="form-control" value='{{$product->name}}'>
                     @error('name') <p class='alert alert-danger mt-2'>{{$message}}</p> @enderror
                </label>
            </div>
            <div class="form-group">
            <label for="category">Category:</label>
                <select name="category" id="category" class="form-select">
                    <option>--Select a category--</option>
                    <option value="Electronics" {{$product->category=='Electronics' ? 'selected' : ''}}>Electronics</option>
                    <option value="Fruits" {{$product->category=='Fruits' ? 'selected' : ''}}>Fruits</option>
                    <option value="Furnitures" {{$product->category=='Furnitures' ? 'selected' : ''}}>Furnitures</option>
                </select>
                @error('category') <p class='alert alert-danger mt-2'>{{$message}}</p> @enderror
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Price:
                    <input type="numberic" name='price' class="form-control" value='{{$product->price}}'>
                     @error('price') <p class='alert alert-danger mt-2'>{{$message}}</p> @enderror
                </label>
            </div>
            <div class="form-group">
            <label for="visibility">Visible:</label>
                <select name="visibility" id="visibility" class="form-select">
                    <option>--Select Visiblity--</option>
                    <option value="Own" {{$product->visibility=='Own'?'selected':''}}>Own</option>
                    <option value="Public" {{$product->visibility=='Public'?'selected':''}}>Public</option>
                </select>
                @error('visible') <p class='alert alert-danger mt-2'>{{$message}}</p> @enderror
            </div>
            <div class="form-group">
                <input type="submit" value='Edit Product' class='btn btn-primary'>
            </div>
        </form> 
        </div>
</body>
</html>