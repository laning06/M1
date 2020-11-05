<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
        <h1>Error</h1>
        <p><?php echo $this->message; ?></p>
        <dl>
            <dt>Fichier :</dt>
            <dd><?php echo $file; ?></dd>
            <dt>Ligne :</dt>
            <dd><?php echo $line; ?></dd>
            <dt>Fonction :</dt>
            <dd><?php echo $function; ?></dd>
        </dl>
        <pre><?php echo $this->getTraceAsString();?></pre>
</body>
</html>