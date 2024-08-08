<!-- app/Views/errors/access_denied.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <!-- This is the main stylesheet for Bootstrap. It includes all the CSS necessary for Bootstrap's components and utilities to work. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include Bootstrap Icons -->
    <!-- This link imports the Bootstrap Icons library, which provides a wide range of SVG icons for use in your projects. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Include FontAwesome Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <main>
        <div class="container text-center mt-5">
            <img src="<?= base_url('images/cross.jpeg'); ?>" width="300" height="300" alt="access_denied">
            <!-- <img src="image/cross.jpeg" width="300" height="300" alt="access_denied"> -->
            <h1>Access Denied</h1>
            <p>You do not have permission to access this page.<br>
            Please contact an administrator to get permissions.</p>
            <!-- <a href="<?//= base_url(); ?>">Return to Homepage</a> -->
            <a href="<?= base_url('/'); ?>" class="btn btn-dark btn-lg mt-3">Return to home </a>
        </div>
    </main>
</body>
</html>
