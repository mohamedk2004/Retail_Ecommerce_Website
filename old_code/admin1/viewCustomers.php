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
            <h2>All Customers</h2>
            <table class="table ">
                <thead>
                    <tr>
                        <th class="text-center">S.N.</th>
                        <th class="text-center">Username </th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Contact Number</th>
                        <th class="text-center">Joining Date</th>
                    </tr>
                </thead>

                <tr>
                    <td>1</td>
                    <td>david sameh</td>
                    <td>davidsameh302@gmail.com</td>
                    <td>01204786460</td>
                    <td>2024-10-28</td>
                </tr>

            </table>
        </div>
    </div>
</body>

</html>