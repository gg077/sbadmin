<?php

require_once("includes/header.php");
require_once("includes/sidebar.php");

$user = new User();
$total_customers = $user->count_all_users(); // Ophalen aantal klanten

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Users List</li>
            </ol>
            <!-- Tabel van gebruikers -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-users me-1"></i>
                            Users
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                <tr>
                                    <th>Klantnummer</th>
                                    <th>Email</th>
                                    <th>Naam</th>
                                    <th>Achternaam</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = $user->find_all_users();
                                if ($result && mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['klantnr'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($row['naam'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($row['achternaam'], ENT_QUOTES, 'UTF-8') ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Geen klanten gevonden</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grafiek van aantal klanten -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Klantenoverzicht
                        </div>
                        <div class="card-body">
                            <canvas id="customerChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Script voor de Chart.js grafiek -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ophalen van aantal klanten vanuit PHP
    const totalCustomers = <?= $total_customers; ?>;

    // Configureren en weergeven van de chart
    const ctx = document.getElementById('customerChart').getContext('2d');
    const customerChart = new Chart(ctx, {
        type: 'bar', // Type grafiek
        data: {
            labels: ['Aantal Klanten'], // X-as label
            datasets: [{
                label: 'Aantal Klanten',
                data: [totalCustomers], // Y-as data
                backgroundColor: ['rgba(75, 192, 192, 0.6)'], // Kleur van de balk
                borderColor: ['rgba(75, 192, 192, 1)'], // Randkleur
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Start Y-as vanaf 0
                }
            }
        }
    });
</script>

<?php

require_once("includes/footer.php");

?>
