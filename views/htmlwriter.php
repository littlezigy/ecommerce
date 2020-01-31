<?php
class htmlwriter {

    public function select(String $name, $options) {
        $output = "<select name = $name>";
        foreach($options as $option) {
            $output .= "<option>$option</option>";
        }
        $output .= "</select>";
        return $output;
    }
    
}