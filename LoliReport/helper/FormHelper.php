<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 25.10.2017
 * Time: 10:46
 */

namespace helper;

class FormHelper extends BaseHelper
{

    public function createForm(
                                string $id,
                                string $name,
                               string $action,
                               string $method
    ):string{
        return "<form id='$id' action='$action' method='$method' name='$name'>";
    }

    public function createFormWithEnctype(
        string $id,
        string $name,
        string $action,
        string $method = 'POST',
        string $enctype

    ):string{
        return "<form id='$id' action='$action' method='$method' name='$name' enctype='$enctype'>";
    }

    public function inputGroup(string $name, string $classes, array $options = [], string $value, $type, $divClass, $labelClass ){
        $this->renderer->setAttribute('name', $name);
        $this->renderer->setAttribute('classes', $classes);
        $this->renderer->setAttribute('value', $value);
        $this->renderer->setAttribute('type', $type);
        $this->renderer->setAttribute('options', $options);
        $this->renderer->setAttribute('labelClass', $labelClass);
        $this->renderer->setAttribute('divClass', $divClass);
        $this->renderer->setAttribute('labelText', $options['label']);
        $this->renderer->renderByFileName('input-group.php');
    }

    public function input(
        string $name,
        string $classes,
        array $options = []
    ){
        return "<input id='$name' type='text' name='$name' class='$classes'>";
    }

    public function endForm():string{
        return "</form>";
    }

}
