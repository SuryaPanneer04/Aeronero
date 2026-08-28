<?php
require '../../connect.php';
$id = $_GET['id'] ?? 0;
if (!$id) {
    header('Location: index.php');
    exit;
}
$stmt = $con->prepare("SELECT * FROM product_master WHERE id = ? AND status = 1");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
    header('Location: index.php');
    exit;
}
$image = !empty($product['image']) ? '../../images/' . $product['image'] : 'https://via.placeholder.com/500x300?text=' . urlencode($product['name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - QVision</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">← Back to Products</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6">
                <img src="<?php echo $image; ?>" class="img-fluid rounded shadow" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="col-lg-6">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="lead"><?php echo htmlspecialchars($product['description'] ?? 'Premium quality product'); ?></p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Model:</strong> <?php echo htmlspecialchars($product['model_name'] ?? 'N/A'); ?></li>
                    <li class="list-group-item"><strong>Product ID:</strong> <?php echo htmlspecialchars($product['product_id'] ?? 'N/A'); ?></li>
                    <li class="list-group-item"><strong>HSN Code:</strong> <?php echo htmlspecialchars($product['hsn_code'] ?? 'N/A'); ?></li>
                    <li class="list-group-item"><strong>GST Code:</strong> <?php echo htmlspecialchars($product['gst_code'] ?? 'N/A'); ?></li>
                    <li class="list-group-item"><strong>Type:</strong> <?php echo htmlspecialchars($product['type'] ?? 'N/A'); ?></li>
                </ul>
                <div class="mt-4">
                    <a href="/qvision/CRM/enquiry.php?product=<?php echo $id; ?>" class="btn btn-success btn-lg w-100 mb-2">
                        <i class="fas fa-shopping-cart"></i> Get Quote / Enquiry
                    </a>
                    <a href="index.php" class="btn btn-outline-primary w-100">← Back to Products</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
