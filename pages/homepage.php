<?php
session_start();
// include("config/db.php"); // Uncomment when database is populated
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eukim Motors | Premium Car Sales & Global Imports</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark-main: #121212;
            --bg-dark-card: #1e1e1e;
            --accent-blue: #0d6efd;
            --accent-green: #198754;
            --border-color: #2d2d2d;
            --text-muted: #888888;
        }

        body {
            background-color: var(--bg-dark-main);
            color: #e0e0e0;
            font-family: system-ui, -apple-system, sans-serif;
        }

        /* --- Global Custom Navigation --- */
        .custom-nav {
            background-color: var(--bg-dark-card);
            border-bottom: 1px solid var(--border-color);
            padding: 15px 5%;
        }

        .navbar-brand img {
            max-width: 130px;
            height: auto;
        }

        .nav-link-custom {
            color: #b3b3b3;
            font-weight: 500;
            padding: 8px 16px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-link-custom:hover, .nav-link-custom.active {
            color: #fff;
        }

        .btn-accent {
            background-color: rgba(13, 110, 253, 0.15);
            color: #fff;
            border: 1px solid var(--accent-blue);
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-accent:hover {
            background-color: var(--accent-blue);
            color: #fff;
            box-shadow: 0 0 15px rgba(13, 110, 253, 0.4);
        }

        /* --- Premium Hero Section --- */
        .hero-showroom {
            background: linear-gradient(rgba(18, 18, 18, 0.85), rgba(18, 18, 18, 0.95)), url('../assets/black.jpg') no-repeat center center fixed;
            background-size: cover;
            padding: 100px 0 80px 0;
            text-align: center;
        }

        .hero-showroom h1 {
            font-size: 3rem;
            letter-spacing: -0.5px;
        }

        /* --- Dashboard-Styled Search Component --- */
        .search-panel {
            background-color: var(--bg-dark-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.5);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .form-select-custom {
            background-color: var(--bg-dark-main);
            border: 1px solid var(--border-color);
            color: #e0e0e0;
            padding: 12px;
            border-radius: 8px;
        }

        .form-select-custom:focus {
            background-color: var(--bg-dark-main);
            border-color: var(--accent-blue);
            color: #fff;
            box-shadow: none;
        }

        /* --- Feature / Metric Style Blocks --- */
        .feature-box {
            background-color: var(--bg-dark-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 30px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .feature-box:hover {
            transform: translateY(-4px);
            border-color: var(--accent-blue);
        }

        .feature-icon-wrapper {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            background-color: rgba(13, 110, 253, 0.1);
            color: var(--accent-blue);
            margin-bottom: 20px;
        }

        /* --- Product Catalog Grid Styling --- */
        .showroom-card {
            background-color: var(--bg-dark-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            transition: transform 0.2s ease;
        }

        .showroom-card:hover {
            transform: translateY(-4px);
        }

        .vehicle-img-wrapper {
            height: 210px;
            background-color: #252525;
            position: relative;
        }

        .vehicle-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-badge-floating {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: rgba(25, 135, 84, 0.25);
            color: #198754;
            border: 1px solid rgba(25, 135, 84, 0.4);
            padding: 6px 12px;
            border-radius: 20px;
        }
        
        .status-badge-floating.sold {
            background-color: rgba(220, 53, 69, 0.25);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.4);
        }

        .card-spec-pill {
            background-color: var(--bg-dark-main);
            border: 1px solid var(--border-color);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 13px;
            color: var(--text-muted);
        }

        /* --- Custom Footer --- */
        footer {
            background-color: var(--bg-dark-card);
            border-top: 1px solid var(--border-color);
            color: var(--text-muted);
            padding: 30px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR ALIGNED HORIZONTAL NAVBAR -->
    <header class="custom-nav d-flex justify-content-between align-items-center">
        <a class="navbar-brand m-0" href="index.php">
            <img src="../assets/logo.png" alt="Eukim Motors">
        </a>
        <nav class="d-none d-md-flex align-items-center gap-2">
            <a class="nav-link-custom active" href="index.php">Home</a>
            <a class="nav-link-custom" href="inventory.php">Local Stock</a>
            <a class="nav-link-custom" href="imports.php">Global Logistics</a>
            <a class="nav-link-custom" href="contact.php">Contact</a>
        </nav>
        <div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="pages/dashboard.php" class="btn-accent"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <?php else: ?>
                <a href="auth/login.php" class="btn-accent"><i class="bi bi-box-arrow-in-right me-2"></i>Portal Access</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- PREMIUM HERO PRESENTATION -->
    <section class="hero-showroom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold text-white mb-2">Sourced Locally. Imported Globally.</h1>
                    <p class="fs-5 text-secondary mb-0">Experience structural integrity and premium delivery logistics engineered by Eukim Motors.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SEARCH UTILITY CONTAINER -->
    <section class="container px-4">
        <div class="search-panel">
            <form action="inventory.php" method="GET" class="row g-3">
                <div class="col-12 col-md-3">
                    <select name="status" class="form-select form-select-custom">
                        <option value="">Market Allocation</option>
                        <option value="local">Available Local Inventory</option>
                        <option value="import">Ready-to-Ship Logistics</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <select name="make" class="form-select form-select-custom">
                        <option value="">Select Manufacturer</option>
                        <option value="toyota">Toyota</option>
                        <option value="bmw">BMW</option>
                        <option value="mercedes">Mercedes-Benz</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <select name="price" class="form-select form-select-custom">
                        <option value="">Maximum Budget Allocation</option>
                        <option value="20000">$20,000 Cap</option>
                        <option value="40000">$40,000 Cap</option>
                        <option value="80000">$80,000 Cap</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <button type="submit" class="btn btn-primary w-100 py-2.5 fw-semibold rounded-3" style="height: 100%;">
                        <i class="bi bi-sliders me-2"></i>Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- VALUE METRIC HOVER SECTIONS -->
    <section class="container my-5 py-4">
        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="feature-box">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="h5 fw-bold text-white mb-2">Inspected Infrastructure</h3>
                    <p class="text-secondary m-0 small lh-base">Every vehicle listed goes through rigorous mechanical auditing prior to showroom compound registry.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="feature-box">
                    <div class="feature-icon-wrapper" style="background-color: rgba(25, 135, 84, 0.1); color: var(--accent-green);">
                        <i class="bi bi-globe2"></i>
                    </div>
                    <h3 class="h5 fw-bold text-white mb-2">Direct Global Sourcing</h3>
                    <p class="text-secondary m-0 small lh-base">End-to-end clearing pipelines from major global terminals directly handled by our customs agency.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="feature-box">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <h3 class="h5 fw-bold text-white mb-2">Transparent Transactions</h3>
                    <p class="text-secondary m-0 small lh-base">Clear breakdown pricing sheets covering shipping, custom duties, and local inspection fees.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- RECENT PREMIUM UNITS EXHIBIT -->
    <main class="container mb-5 pb-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="h4 fw-bold text-white m-0">Recent Fleet Inventory</h2>
                <p class="text-secondary small m-0">Live stock tracking from Eukim Motors catalog system</p>
            </div>
            <a href="inventory.php" class="btn btn-sm btn-outline-secondary px-3 rounded-2">View Showroom Catalog</a>
        </div>

        <div class="row g-4">
            <!-- Mock Showcase Card 1 -->
            <div class="col-12 col-md-4">
                <div class="showroom-card">
                    <div class="vehicle-img-wrapper">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxhtQA7-qW7LufMMPOCWws7n5sCs5msHaWCw&s" alt="Vehicle Asset" class="vehicle-img">
                        <span class="status-badge-floating">Available</span>
                    </div>
                    <div class="p-4">
                        <span class="text-primary fw-bold text-uppercase fs-6 tracking-wider d-block mb-1">Toyota</span>
                        <h4 class="h5 fw-bold text-white mb-3">Land Cruiser Prado</h4>
                        <div class="d-flex gap-2 mb-4">
                            <span class="card-spec-pill">2019</span>
                            <span class="card-spec-pill">Automatic</span>
                            <span class="card-spec-pill">Diesel</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-4 fw-bold text-white">Ksh 7,250,000</span>
                            <a href="#" class="text-decoration-none fw-semibold text-primary">Details <i class="bi bi-arrow-right-short ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mock Showcase Card 2 -->
            <div class="col-12 col-md-4">
                <div class="showroom-card">
                    <div class="vehicle-img-wrapper">
                        <img src="data:image/jpeg;base64,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" alt="Vehicle Asset" class="vehicle-img">
                        <span class="status-badge-floating sold">Sold Out</span>
                    </div>
                    <div class="p-4">
                        <span class="text-primary fw-bold text-uppercase fs-6 tracking-wider d-block mb-1">BMW</span>
                        <h4 class="h5 fw-bold text-white mb-3">3 Series M-Sport</h4>
                        <div class="d-flex gap-2 mb-4">
                            <span class="card-spec-pill">2021</span>
                            <span class="card-spec-pill">Automatic</span>
                            <span class="card-spec-pill">Petrol</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-4 fw-bold text-white">Ksh 5,900,000</span>
                            <a href="#" class="text-decoration-none fw-semibold text-primary">Details <i class="bi bi-arrow-right-short ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mock Showcase Card 3 -->
            <div class="col-12 col-md-4">
                <div class="showroom-card">
                    <div class="vehicle-img-wrapper">
                        <img src="https://paultan.org/image/2020/07/2020-Mercedes-Benz-C200-AMG-Line-with-2.0L-Engine-14.jpg" alt="Vehicle Asset" class="vehicle-img">
                        <span class="status-badge-floating">Available</span>
                    </div>
                    <div class="p-4">
                        <span class="text-primary fw-bold text-uppercase fs-6 tracking-wider d-block mb-1">Mercedes-Benz</span>
                        <h4 class="h5 fw-bold text-white mb-3">C-Class C200</h4>
                        <div class="d-flex gap-2 mb-4">
                            <span class="card-spec-pill">2020</span>
                            <span class="card-spec-pill">Automatic</span>
                            <span class="card-spec-pill">Hybrid</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-4 fw-bold text-white">Ksh 4,300,800</span>
                            <a href="#" class="text-decoration-none fw-semibold text-primary">Details <i class="bi bi-arrow-right-short ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER TERMINAL -->
    <footer class="text-center">
        <p class="m-0">&copy; <?php echo date("Y"); ?> Eukim Motors Ltd. All Rights Reserved. Asset Inventory Architecture.</p>
    </footer>

    <!-- Bootstrap 5 Bundle with Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>