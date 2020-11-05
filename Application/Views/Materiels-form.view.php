<h2>Ajouter un equipement</h2>
<?php if(isset($this->formMessage)):?>
<p><?php echo $this->formMessage;?></p>
<?php endif; ?>
<form action="" method="POST">
    <div>
        <label for="descriptions">Description :</label>
        <input type="text" name="descriptions" placeholder="Description de l'équipement"
            Value="<?php echo filter_var($this->descriptions,
                        FILTER_SANITIZE_FULL_SPECIAL_CHARS);?>">
    </div>

    <div>
        <label for="ip">Adresse Ip</label>
        <input type="text" id="ip" name="ip" placeholder="Adresse ip" 
        Value="<?php echo filter_var($this->ip,
                        FILTER_SANITIZE_FULL_SPECIAL_CHARS);?>">
    </div>
    <button type="submit">Envoyer</button>
</form>