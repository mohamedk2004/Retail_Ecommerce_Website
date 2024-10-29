<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="./style.css"></link>
  </head>
</head>
<script type="text/javascript" src="./ajaxWork.js"></script>    
    <script type="text/javascript" src="./script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<body >
    <?php
            include "./adminHeader.php";
            include "./sidebar.php";
           
           // include_once "./config/dbconnect.php";
        ?>
<div id="main-content" class="container allContent-section py-4">
<div >
  <h3>Category Items</h3>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Category Name</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>

    <tr>
      <td>1</td>
      <td>tops</td>   
      
      <td><button class="btn btn-danger" style="height:40px" >Delete</button></td>
      </tr>

      <tr>
      <td>2</td>
      <td>shorts</td>   
      
      <td><button class="btn btn-danger" style="height:40px" >Delete</button></td>
      </tr>

      <tr>
      <td>3</td>
      <td>dresses</td>   
      
      <td><button class="btn btn-danger" style="height:40px" >Delete</button></td>
      </tr>

      <tr>
      <td>4</td>
      <td>pants</td>   
      
      <td><button class="btn btn-danger" style="height:40px" >Delete</button></td>
      </tr>
      
  </table>

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">
    Add Category
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Category Item</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="addCategoryForm">
                            <div class="form-group">
                                <label for="c_name">Category Name:</label>
                                <input type="text" class="form-control" name="c_name" id="c_name" required>
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="addCategory()" class="btn btn-secondary" style="height:40px">Add Category</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<script>
function addCategory() {
    const categoryName = document.getElementById("c_name").value;

    if (!categoryName) return;

    const tableBody = document.querySelector('table tbody');
    const rowCount = tableBody.rows.length + 1;
    const newRow = `
        <tr>
            <td class="text-center">${rowCount}</td>
            <td class="text-center">${categoryName}</td>
            <td class="text-center">
                <button class="btn btn-danger" style="height:40px" onclick="deleteRow(this)">Delete</button>
            </td>
        </tr>
    `;
    tableBody.insertAdjacentHTML('beforeend', newRow);

    $('#myModal').modal('hide');
    document.getElementById("addCategoryForm").reset();
}

function deleteRow(button) {
    const row = button.closest('tr');
    row.remove();
}
</script>
