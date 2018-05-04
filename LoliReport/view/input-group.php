<div class="<?PHP echo $this->divClass ?>">
    <label for="<?PHP echo $this->name ?>" class="<?PHP echo $this->labelClass ?>"><?php echo $this->labelText ?></label>
    <input id="<?PHP echo $this->name ?>" name="<?PHP echo $this->name ?>" <?php echo $this->attributes ?> class="<?php echo $this->classes ?>" value="<?php echo $this->value?>"  type="<?php echo $this->type ?>">
    <span class="focus-border"></span>
</div>
