<?php
session_start();

// Security Guard: Restrict access if not authenticated or not an admin
// Customize this block depending on your database column configuration
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
// if ($_SESSION['role'] !== 'admin') { header("Location: ../index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eukim Motors | Admin Control Center</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark-main: #121212;
            --bg-dark-card: #1e1e1e;
            --accent-blue: #0d6efd;
            --accent-green: #198754;
            --accent-orange: #fd7e14;
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

        .btn-logout {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.4);
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: #dc3545;
            color: #fff;
            box-shadow: 0 0 15px rgba(220, 53, 69, 0.4);
        }

        /* --- Dashboard Panel Cards --- */
        .metric-card {
            background-color: var(--bg-dark-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        /* --- Control Table Framework --- */
        .data-panel {
            background-color: var(--bg-dark-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        .table-custom {
            color: #e0e0e0;
            margin-bottom: 0;
        }

        .table-custom th {
            background-color: var(--bg-dark-main) !important;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 12px 16px;
        }

        .table-custom td {
            background-color: transparent !important;
            color: #e0e0e0;
            border-bottom: 1px solid var(--border-color);
            padding: 16px;
            vertical-align: middle;
        }

        .badge-status {
            font-size: 11px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .badge-local { background: rgba(13, 110, 253, 0.15); color: #0d6efd; border: 1px solid rgba(13, 110, 253, 0.3); }
        .badge-transit { background: rgba(253, 126, 20, 0.15); color: #fd7e14; border: 1px solid rgba(253, 126, 20, 0.3); }
        .badge-sold { background: rgba(220, 53, 69, 0.15); color: #dc3545; border: 1px solid rgba(220, 53, 69, 0.3); }

        /* --- Footer Style --- */
        footer {
            background-color: var(--bg-dark-card);
            border-top: 1px solid var(--border-color);
            color: var(--text-muted);
            padding: 20px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <header class="custom-nav navbar navbar-expand-md navbar-dark">
        <div class="container-fluid p-0">
            <a class="navbar-brand me-4" href="../index.php">
                <img src="../assets/logo.png" alt="Eukim Motors">
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <nav class="navbar-nav me-auto mb-2 mb-md-0 gap-1">
                    <a class="nav-link-custom active" href="dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Overview</a>
                    <a class="nav-link-custom" href="manage-inventory.php"><i class="bi bi-car-front me-2"></i>Fleet Manager</a>
                    <a class="nav-link-custom" href="import-tracking.php"><i class="bi bi-globe2 me-2"></i>Import Pipelines</a>
                    <a class="nav-link-custom" href="leads.php"><i class="bi bi-envelope me-2"></i>Inquiries</a>
                </nav>
                <div class="d-flex mt-2 mt-md-0">
                    <a href="../auth/logout.php" class="btn-logout"><i class="bi bi-box-arrow-left me-2"></i>Terminate Session</a>
                </div>
            </div>
        </div>
    </header>

    <section class="container my-4 py-2">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 fw-bold text-white mb-1">Administrative Control System</h1>
                <p class="text-secondary m-0">Eukim Motors live system matrix architecture and asset allocations.</p>
            </div>
        </div>
    </section>

    <section class="container mb-5">
        <div class="row g-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="metric-card d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-secondary small d-block mb-1 text-uppercase tracking-wider fw-semibold">Active Fleet Value</span>
                        <h3 class="fw-bold text-white m-0">Ksh 48.6M</h3>
                    </div>
                    <div class="metric-icon" style="background-color: rgba(13, 110, 253, 0.1); color: var(--accent-blue);">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="metric-card d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-secondary small d-block mb-1 text-uppercase tracking-wider fw-semibold">Active Clearances</span>
                        <h3 class="fw-bold text-white m-0">14 Units</h3>
                    </div>
                    <div class="metric-icon" style="background-color: rgba(253, 126, 20, 0.1); color: var(--accent-orange);">
                        <i class="bi bi-ship"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="metric-card d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-secondary small d-block mb-1 text-uppercase tracking-wider fw-semibold">Showroom Inquiries</span>
                        <h3 class="fw-bold text-white m-0">38 Leads</h3>
                    </div>
                    <div class="metric-icon" style="background-color: rgba(25, 135, 84, 0.1); color: var(--accent-green);">
                        <i class="bi bi-chat-left-text"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="metric-card d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-secondary small d-block mb-1 text-uppercase tracking-wider fw-semibold">Registered Brokers</span>
                        <h3 class="fw-bold text-white m-0">129 Users</h3>
                    </div>
                    <div class="metric-icon" style="background-color: rgba(255, 255, 255, 0.05); color: #fff;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="container mb-5">
        <div class="row g-4">
            
            <div class="col-12 col-lg-8">
                <div class="data-panel">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="h5 fw-bold text-white m-0">Showroom Inventory Manifest</h2>
                            <p class="text-secondary small m-0">Current status tracking of local stocks and global assignments.</p>
                        </div>
                        <a href="add-vehicle.php" class="btn btn-sm btn-primary px-3 rounded-2"><i class="bi bi-plus-lg me-1"></i> Register Asset</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Vehicle Identification</th>
                                    <th>Allocation</th>
                                    <th>Financial Valuation</th>
                                    <th>Management Matrix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Toyota Land Cruiser Prado</div>
                                        <div class="text-muted small">ID: #EUK-2019-004</div>
                                    </td>
                                    <td><span class="badge-status badge-local">Local Stock</span></td>
                                    <td class="fw-semibold">Ksh 7,250,000</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="edit.php?id=1" class="btn btn-outline-secondary border-secondary-subtle text-white"><i class="bi bi-pencil"></i></a>
                                            <a href="delete.php?id=1" class="btn btn-outline-danger" onclick="return confirm('Confirm operational deletion?');"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">BMW 3 Series M-Sport</div>
                                        <div class="text-muted small">ID: #EUK-2021-012</div>
                                    </td>
                                    <td><span class="badge-status badge-sold">Sold Out</span></td>
                                    <td class="fw-semibold">Ksh 5,900,000</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="edit.php?id=2" class="btn btn-outline-secondary border-secondary-subtle text-white"><i class="bi bi-pencil"></i></a>
                                            <a href="delete.php?id=2" class="btn btn-outline-danger" onclick="return confirm('Confirm operational deletion?');"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Mercedes-Benz C-Class C200</div>
                                        <div class="text-muted small">ID: #EUK-2020-089</div>
                                    </td>
                                    <td><span class="badge-status badge-transit">Mombasa Transit</span></td>
                                    <td class="fw-semibold">Ksh 4,300,800</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="edit.php?id=3" class="btn btn-outline-secondary border-secondary-subtle text-white"><i class="bi bi-pencil"></i></a>
                                            <a href="delete.php?id=3" class="btn btn-outline-danger" onclick="return confirm('Confirm operational deletion?');"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="data-panel">
                    <h2 class="h5 fw-bold text-white mb-4">Recent Audit Stream</h2>
                    
                    <div class="d-flex flex-column gap-3">
                        <div class="p-3 rounded-3 bg-body-tertiary" style="background-color: var(--bg-dark-main) !important; border: 1px solid var(--border-color);">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="badge text-bg-primary font-monospace small">LEAD INBOUND</span>
                                <span class="text-muted small">4 mins ago</span>
                            </div>
                            <p class="text-white small m-0 fw-semibold">Inquiry on Prado from j***@gmail.com</p>
                        </div>

                        <div class="p-3 rounded-3 bg-body-tertiary" style="background-color: var(--bg-dark-main) !important; border: 1px solid var(--border-color);">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="badge text-bg-success font-monospace small">SALE CONFIRMED</span>
                                <span class="text-muted small">2 hrs ago</span>
                            </div>
                            <p class="text-white small m-0 fw-semibold">BMW 3 Series changed status to "Sold Out"</p>
                        </div>

                        <div class="p-3 rounded-3 bg-body-tertiary" style="background-color: var(--bg-dark-main) !important; border: 1px solid var(--border-color);">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="badge text-bg-warning text-dark font-monospace small">CUSTOMS CLEARING</span>
                                <span class="text-muted small">1 day ago</span>
                            </div>
                            <p class="text-white small m-0 fw-semibold">Mercedes C200 arrived at Japan Terminal</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="text-center">
        <p class="m-0">&copy; <?php echo date("Y"); ?> Eukim Motors Ltd. Admin Architecture Portal.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>