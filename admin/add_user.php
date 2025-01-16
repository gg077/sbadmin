<?php

require_once("includes/header.php");
require_once("includes/sidebar.php");

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Haal gegevens op uit het formulier
    $email = $_POST['email'];
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];

    // Voeg de gebruiker toe via de User-klasse
    $user = new User();
    if ($user->add_user($email, $naam, $achternaam)) {
        $success_message = "Gebruiker succesvol toegevoegd!";
    } else {
        $error_message = "Er is iets misgegaan. Probeer het opnieuw.";
    }
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                <li class="breadcrumb-item active">Add User</li>
            </ol>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user-plus me-1"></i>
                            Voeg een nieuwe gebruiker toe
                        </div>
                        <div class="card-body">
                            <?php if (!empty($success_message)): ?>
                                <div class="alert alert-success">
                                    <?= htmlspecialchars($success_message) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger">
                                    <?= htmlspecialchars($error_message) ?>
                                </div>
                            <?php endif; ?>

                            <!-- Formulier voor nieuwe gebruiker -->
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="naam" class="form-label">Naam</label>
                                    <input type="text" class="form-control" id="naam" name="naam" required>
                                </div>
                                <div class="mb-3">
                                    <label for="achternaam" class="form-label">Achternaam</label>
                                    <input type="text" class="form-control" id="achternaam" name="achternaam" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Toevoegen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php

require_once("includes/footer.php");

?>
