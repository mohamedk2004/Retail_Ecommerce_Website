<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<script type="text/javascript" src="./ajaxWork.js"></script>
<script type="text/javascript" src="./script.js"></script>

<body>
    <?php
    include "./adminHeader.php";
    include "./sidebar.php";
  ?>
    <div id="main-content" class="container allContent-section py-4">
        <div id="ordersBtn">
            <h2>Order Details</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>O.N.</th>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Order Date</th>
                        <th>Payment Method</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Total Price</th>
                        <th>More Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>David</td>
                        <td>010549864</td>
                        <td>2024-04-10</td>
                        <td>Cash</td>
                        <td><button class="btn btn-danger" onclick="toggleStatus(this)">Pending</button></td>
                        <td><button class="btn btn-danger" onclick="togglePayStatus(this)">Unpaid</button></td>
                        <td>900 LE</td>
                        <td><button class="btn btn-primary openPopup" onclick="showOrderDetails(1)">View</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Angie</td>
                        <td>015498889</td>
                        <td>2024-07-10</td>
                        <td>Fawry</td>
                        <td><button class="btn btn-danger" onclick="toggleStatus(this)">Pending</button></td>
                        <td><button class="btn btn-danger" onclick="togglePayStatus(this)">Unpaid</button></td>
                        <td>$95.00</td>
                        <td><button class="btn btn-primary openPopup" onclick="showOrderDetails(2)">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Order Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="order-view-modal modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                            </tr>
                        </thead>
                        <tbody id="orderDetailsTable">
                            <!-- Product rows will be inserted here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript dependencies -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <script>
    // Sample products data for each order, with added product names
    const orders = {
        1: [{
                no: 1,
                name: 'short dress',
                image: '../assets/imgs/check-strappy-dress.jpg',
                size: 'M',
                quantity: 2,
                unitPrice: 25.00
            },
            {
                no: 2,
                name: 'shirtdress',
                image: '../assets/imgs/shirtdress.jpg',
                size: 'L',
                quantity: 1,
                unitPrice: 35.00
            }
        ],
        2: [{
                no: 1,
                name: 'crop top',
                image: '../assets/imgs/tops.jpg',
                size: 'S',
                quantity: 3,
                unitPrice: 15.00
            },
            {
                no: 2,
                name: 'shirtdress',
                image: '../assets/imgs/shirtdress.jpg',
                size: 'M',
                quantity: 2,
                unitPrice: 20.00
            }
        ]
    };

    // Function to display order details in the modal
    function showOrderDetails(orderId) {
        const products = orders[orderId];
        const orderDetailsTable = document.getElementById('orderDetailsTable');

        // Clear previous rows
        orderDetailsTable.innerHTML = '';

        // Populate table rows
        products.forEach((product, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
          <td>${index + 1}</td>
          <td>${product.name}</td>
          <td><img src="${product.image}" alt="Product Image" style="width: 50px; height: auto;"></td>
          <td>${product.size}</td>
          <td>${product.quantity}</td>
          <td>$${product.unitPrice.toFixed(2)}</td>
        `;
            orderDetailsTable.appendChild(row);
        });

        // Show the modal
        $('#viewModal').modal('show');
    }

    // Toggle Order Status button color and text
    function toggleStatus(button) {
        if (button.classList.contains('btn-danger')) {
            button.classList.remove('btn-danger');
            button.classList.add('btn-success');
            button.innerText = 'Delivered';
        } else {
            button.classList.remove('btn-success');
            button.classList.add('btn-danger');
            button.innerText = 'Pending';
        }
    }

    // Toggle Payment Status button color and text
    function togglePayStatus(button) {
        if (button.classList.contains('btn-danger')) {
            button.classList.remove('btn-danger');
            button.classList.add('btn-success');
            button.innerText = 'Paid';
        } else {
            button.classList.remove('btn-success');
            button.classList.add('btn-danger');
            button.innerText = 'Unpaid';
        }
    }
    </script>
</body>

</html>