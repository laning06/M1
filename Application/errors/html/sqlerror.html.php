<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQLERROR</title>
</head>
<body>
    <h1>SQL Error</h1>
    <p><?php echo $this->message;?></p>
    <p><?php echo $this->querry->querryString; ?></p>
    <pre><?php echo $this->querry->debuDumpParams();?></pre>
    <dl>
        <dt>Fichier :</dt>
        <dd><?php echo $file; ?></dd>
        <dt>Ligne</dt>
        <dd><?php echo $ligne; ?></dd>
        <dt>Fonction</dt>
        <dd><?php echo $function; ?></dd>
    </dl>
    <pre><?php echo $this->getTraceAsString();  ?></pre>
</body>
</html>