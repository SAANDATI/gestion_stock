<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    
<div class="row">
    <div class="col-lg-10 offset-1">

    <br> 
    <form>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Libelle</label>
    <input type="text" class="form-control" id="libelle" aria-describedby="Libelle">
    </div>
    <button id="validate" type="submit" class="btn btn-primary">Add</button>
    </form>

    </div>
</div>

<br> <br>
<div class="row">
    <div class="col-lg-10 offset-1">

    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Libelle</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="categories">
            
        </tbody>
</table>

</div>
</div>

<br><br>

<script>
    var categorie_id

    function getCategories(){

        $.get("http://localhost/gestionStock/controller/CategorieController.php?action=read").done((data)=>{

            var categories = JSON.parse(data);
            for(var c of categories){
                $("#categories").append('<tr><td>'+c.id+'</td><td>'+c.libelle+
                '</td><td><button type="button" class="btn btn-success">Modifier</button></td> <td><button type="button" class="btn btn-danger">Supprimer</button></td>')
            
                
            }
        })
    }

    $(document).ready(function(){

        getCategories()
    })
</script>

</body>
</html>