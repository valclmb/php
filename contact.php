<?php
include 'includes/header.php';

$errors = [];

if (isset($_POST['subject'])) {
    $subject = trim($_POST['subject']);
    if (empty($subject)) {
        $errors[] = 'Veuillez entrer un sujet';
    }
    if (strlen($subject) <= 3) {
        $errors[] = 'Veuillez entrer un sujet d\'au moins 3 caractères';
    }
}
if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Veuillez entrer un email valide';
    }
}
if (isset($_POST['content'])) {
    $content = trim($_POST['content']);
    if (empty($content) || strlen($content) <= 40) {
        $errors[] = 'Veuillez entrer un message d\'au moins 40 caractères';
    }
}

if (empty($errors)) {
    $_SESSION['contact'] = [
        'subject' => trim($_POST['subject']),
        'email'   => trim($_POST['email']),
        'content' => trim($_POST['content']),
    ];
}
?>
<form action="contact.php" method="POST">
    <?php
        foreach ($errors as $error) {
            ?>
    <div class="alert alert-danger" role="alert">
        <?php
                echo $error; ?>
    </div>
    <?php
        } ?>
    <div class="form-group">
        <label for="subject">Sujet de votre message</label>
        <input type="text" name="subject" class="form-control" id="subject" required>
    </div>
    <div class="form-group">
        <label for="email">Adresse email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
        <small id="emailHelp" class="form-text text-muted">
            Entrez votre adresse email, que nous puissions répondre à votre message
        </small>
    </div>
    <div class="form-group">
        <label for="content">Votre message</label>
        <textarea name="content" id="content" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<?php
include 'includes/footer.php';
