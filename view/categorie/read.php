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

    <br><br>
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

    function add(){

        libelle = $('#libelle').val()
        $.post("https://g-stocks.herokuapp.com/controller/CategorieController.php?action=create", 
        {libelle:libelle}).done((data)=>{

            if (data.trim()=="OK") {
                message("Enregistrement", "success", "categorie Enregister")
                getCategories();
                clear();
            } else {
                message("Erreur", "error", data)
            }
        }) 
    }

    function getCategories(){

        $("#categories").html('')
        $.get("https://g-stocks.herokuapp.com/controller/CategorieController.php?action=read").done((data)=>{

            console.log(data);
            var categories = JSON.parse(data);
            for(var c of categories){
                $("#categories").append('<tr><td>'+c.id+'</td><td>'+c.libelle+
                '</td><td><button type="button" class="btn btn-success" onclick="edit('+c.id+')">Modifier</button></td> <td><button type="button" onclick="remove('+c.id+')" class="btn btn-danger">Supprimer</button></td>')
                            
            }
        })
}

    function remove(id){
        Swal.fire({
            title:"Etes vous sur?",
            text:"La suppression est definitive",
            icon:"warning",
            showCancelButton:true,
            cancelButtonText:'annuler',
            confirmButtonText:'oui',
            cancelButtonColor:'#d33',
            confirmButtonColor:'#3085d6'
        }).then((res)=>{
            if (res.isConfirmed) {
                $.get("https://g-stocks.herokuapp.com/controller/CategorieController.php?action=delete&id="+id).
                done((data)=>{
                    message('Suppression', 'success', 'categorie supprimer')
                    getCategories()
                })
            } else {
                
            }
        })
    }
    function edit(id){

        categorie_id = id;
        $.get("https://g-stocks.herokuapp.com/controller/CategorieController.php?action=one&id="+id).done((data)=>{
            this.categorie = JSON.parse(data);
            $('#libelle').val(categorie.libelle)
            $('#validate').html('Update')
        })
    }

    function update(id){

        libelle = $('#libelle').val()

        Swal.fire({
            title:"Etes vous sur?",
            text:"Voulez vous modifier??",
            icon:"question",
            showCancelButton:true,
            cancelButtonText:'annuler',
            confirmButtonText:'oui',
            cancelButtonColor:'#d33',
            confirmButtonColor:'#3085d6'
        }).then((res)=>{
            if (res.isConfirmed) {
                $.post("https://g-stocks.herokuapp.com/controller/CategorieController.php?action=update&id="+id,{libelle:libelle}).
                done((data)=>{
                    if (data.trim()=="OK") {
                        message("Modifier", "success", "categorie modifier")
                        getCategories();
                        $('#validate').html('Add')
                        clear();
                    } else {
                        message("Erreur", "error", data)
                    }
                })
            } 
        })
    }

    function message(titre, icon, message){
        Swal.fire({
            title:titre,
            text:message,
            icon:icon
        })
    }

    function clear(){
        $('#libelle').val('')
    }

    // function getCategories(){

    //     $("#categories").html('')
    //     $.get("https://g-stocks.herokuapp.com/controller/CategorieController.php?action=read").done((data)=>{

    //         console.log(data);
    //         var categories = JSON.parse(data);
    //         for(var c of categories){
    //             $("#categories").append('<tr><td>'+c.id+'</td><td>'+c.libelle+
    //             '</td><td><button type="button" class="btn btn-success" onclick="edit('+c.id+')">Modifier</button></td> <td><button type="button" onclick="remove('+c.id+')" class="btn btn-danger">Supprimer</button></td>')
                            
    //         }
    //     })
    // }

    $(document).ready(function(){

        var categorie;

        getCategories();
        $('#validate').click(function(e){
            e.preventDefault();
            let test = $('#validate').html()

            if (test=='Add') {
                add();
            } else if(test='Update'){
                update(categorie_id)
            }
        })
    })
</script>

</body>
</html>