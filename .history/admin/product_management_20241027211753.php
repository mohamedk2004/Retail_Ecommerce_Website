<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Product Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_styles.css">
</head>

<body>
    <div class="d-flex">
        im-->


        <!-- Main Content -->
        <div class="content flex-grow-1">
            <!-- Top Navigation -->
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <h5 class="navbar-brand">Product List</h5>
                <div>
                    <span>Asfak Mahmud</span>
                    <img src="https://via.placeholder.com/40" alt="Admin" class="rounded-circle ms-2">
                </div>
            </nav>

            <!-- Action Buttons and Search -->
            <div class="container-fluid my-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <button class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Add</button>
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Option 1</a></li>
                                <li><a class="dropdown-item" href="#">Option 2</a></li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <select class="form-select form-select-sm w-auto d-inline-block">
                            <option selected>100</option>
                            <option value="1">50</option>
                            <option value="2">25</option>
                            <option value="3">10</option>
                        </select>
                        <input type="text" class="form-control form-control-sm d-inline-block w-auto"
                            placeholder="Search">
                    </div>
                </div>

                <!-- Product Table -->
                <table class="table table-hover mt-3">
                    <thead class="table-light">
                        <tr>
                            <th scope="col"><input type="checkbox"></th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><img src="https://via.placeholder.com/40" alt="Product Image"></td>
                            <td>Coffee Maker</td>
                            <td>4122 Tk</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <!-- More rows can be added here -->
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav>
                    <ul class="pagination pagination-sm justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>