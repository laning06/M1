<h2>Test view</h2>
<?php
    $message = \f3il\Messenger::getMessage();
    if($message !==false):
?>

<p><?php echo $message; ?></p>
<?php 
endif; ?>
<ul>

<?php foreach ($this->materiels as $n):?>
<li><?php echo 
filter_var($n['descriptions'], FILTER_SANITIZE_SPECIAL_CHARS),
''.
filter_var($n['ip'], FILTER_SANITIZE_SPECIAL_CHARS);?>
<a href="?controllers=materiels&action=modifier&id=<?php echo $n['id'];?>">
Modifier
</a>
</li>
<?php endforeach; ?>
</ul>