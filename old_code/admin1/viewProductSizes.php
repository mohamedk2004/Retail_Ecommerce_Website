<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./style.css">
        </link>
    </head>
</head>
<script type="text/javascript" src="./ajaxWork.js"></script>
<script type="text/javascript" src="./script.js"></script>

<body>
    <?php
            include "./adminHeader.php";
            include "./sidebar.php";
           
           // include_once "./config/dbconnect.php";
        ?>
    <div id="main-content" class="container allContent-section py-4">
        <div>
            <h2>Product Detils</h2>
            <table class="table ">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Stock Quantity</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>

                <tr>
                    <td>1</td>
                    <td>Lunch Box</td>
                    <td>L</td>
                    <td>7</td>
                    <td><button class="btn btn-primary" style="height:40px" onclick="editVariation(this)">Edit</button>
                    </td>
                    <td><button class="btn btn-danger" style="height:40px" onclick="deleteRow(this)">Delete</button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Printed Crop Top </td>
                    <td>L</td>
                    <td>10</td>
                    <td><button class="btn btn-primary" style="height:40px" onclick="editVariation(this)">Edit</button>
                    </td>
                    <td><button class="btn btn-danger" style="height:40px" onclick="deleteRow(this)">Delete</button>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Check Strappy Dress</td>
                    <td>S</td>
                    <td>25</td>
                    <td><button class="btn btn-primary" style="height:40px" onclick="editVariation(this)">Edit</button>
                    </td>
                    <td><button class="btn btn-danger" style="height:40px" onclick="deleteRow(this)">Delete</button>
                    </td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>Floral Dress</td>
                    <td>S</td>
                    <td>5</td>
                    <td><button class="btn btn-primary" style="height:40px" onclick="editVariation(this)">Edit</button>
                    </td>
                    <td><button class="btn btn-danger" style="height:40px" onclick="deleteRow(this)">Delete</button>
                    </td>
                </tr>

                <tr>
                    <td>5</td>
                    <td>Off Shoulder Crop Top</td>
                    <td>M</td>
                    <td>30</td>
                    <td><button class="btn btn-primary" style="height:40px" onclick="editVariation(this)">Edit</button>
                    </td>
                    <td><button class="btn btn-danger" style="height:40px" onclick="deleteRow(this)">Delete</button>
                    </td>
                </tr>

            </table>

            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal"
                data-target="#myModal">
                Add Size Variation
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">New Product Size Variation</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id="addVariationForm">
                                <div class="form-group">
                                    <label>Product:</label>
                                    <select id="product" required>
                                        <option disabled selected>Select product</option>
                                        <option value="Off Shoulder Crop Top">Off Shoulder Crop Top</option>
                                        <option value="Printed Crop Top">Printed Crop Top</option>
                                        <option value="Check Strappy Dress">Check Strappy Dress</option>
                                        <option value="Floral Dress">Floral Dress</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Size:</label>
                                    <select id="size" required>
                                        <option disabled selected>Select size</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="qty">Stock Quantity:</label>
                                    <input type="number" class="form-control" id="qty" required>
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="addVariation()" class="btn btn-secondary"
                                        style="height:40px">Add Variation</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                style="height:40px">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            </di>
            <div class="modal fade" id="editModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Product Size Variation</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id="editVariationForm">
                                <div class="form-group">
                                    <label>Product:</label>
                                    <select id="editProduct" required>
                                        <option disabled selected>Select product</option>
                                        <option value="Off Shoulder Crop Top">Off Shoulder Crop Top</option>
                                        <option value="Printed Crop Top">Printed Crop Top</option>
                                        <option value="Check Strappy Dress">Check Strappy Dress</option>
                                        <option value="Floral Dress">Floral Dress</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Size:</label>
                                    <select id="editSize" required>
                                        <option disabled selected>Select size</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editQty">Stock Quantity:</label>
                                    <input type="number" class="form-control" id="editQty" required>
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="saveChanges()" class="btn btn-secondary"
                                        style="height:40px">Save Changes</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                style="height:40px">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>


    <script>
    let editRow;

    function addVariation() {
        const product = document.getElementById("product").value;
        const size = document.getElementById("size").value;
        const qty = document.getElementById("qty").value;


        if (!product || !size || !qty) return;

        const tableBody = document.querySelector('table tbody');
        const rowCount = tableBody.rows.length + 1;


        const newRow = `
            <tr>
                <td class="text-center">${rowCount}</td>
                <td class="text-center">${product}</td>
                <td class="text-center">${size}</td>
                <td class="text-center">${qty}</td>
                <td><button class="btn btn-primary" style="height:40px" onclick="editVariation(this)">Edit</button></td>
                <td class="text-center">

                    <button class="btn btn-danger" style="height:40px" onclick="deleteRow(this)">Delete</button>
                </td>
            </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', newRow);


        $('#myModal').modal('hide');
        document.getElementById("addVariationForm").reset();
    }

    function editVariation(button) {
        editRow = button.closest('tr');

        const product = editRow.cells[1].innerText;
        const size = editRow.cells[2].innerText;
        const qty = editRow.cells[3].innerText;

        document.getElementById("editProduct").value = product;
        document.getElementById("editSize").value = size;
        document.getElementById("editQty").value = qty;

        $('#editModal').modal('show');
    }

    function saveChanges() {
        const product = document.getElementById("editProduct").value;
        const size = document.getElementById("editSize").value;
        const qty = document.getElementById("editQty").value;

        editRow.cells[1].innerText = product;
        editRow.cells[2].innerText = size;
        editRow.cells[3].innerText = qty;

        $('#editModal').modal('hide');
    }

    function deleteRow(button) {
        const row = button.closest('tr');
        row.remove();
    }
    </script>