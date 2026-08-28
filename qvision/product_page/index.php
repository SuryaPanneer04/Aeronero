<?php
require '../../connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QVision - Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/qvision/index.php">
                <img src="/qvision/images/quadsel1.png" alt="QVision" height="40">
                QVision Products
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/qvision/index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/qvision/login/login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/qvision/CRM/enquiry.php">Enquiry</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1>Our Products</h1>
                <p class="lead">Discover our premium product range</p>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search products...">
                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="row" id="productContainer">
            <?php
            $sql = $con->query("SELECT * FROM product_master WHERE status=1 ORDER BY id DESC");
            if ($sql->rowCount() == 0) {
                echo '<div class="col-12"><div class="alert alert-info">No products available. Contact admin.</div></div>';
            }
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $image = !empty($row['image']) ? '../../images/' . $row['image'] : 'https://via.placeholder.com/300x200?text=' . urlencode($row['name']);
            ?>
            <div class="col-lg-4 col-md-6 mb-4 product-card" data-name="<?php echo strtolower($row['name']); ?>">
                <div class="card h-100 shadow-sm product-item">
                    <img src="<?php echo $image; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                        <p class="card-text flex-grow-1"><?php echo htmlspecialchars($row['description'] ?? 'High quality product'); ?></p>
                        <p><strong>Model:</strong> <?php echo htmlspecialchars($row['model_name'] ?? 'N/A'); ?></p>
                        <p><strong>Type:</strong> <?php echo htmlspecialchars($row['type'] ?? 'N/A'); ?></p>
                        <div class="mt-auto">
                            <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">&copy; 2024 QVision. All rights reserved.</div>
                <div class="col-md-6 text-md-end">
                    <a href="/qvision/login/login.php" class="text-white">Admin Login</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('.product-card').forEach(card => {
                const name = card.dataset.name;
                card.style.display = name.includes(searchTerm) ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>
