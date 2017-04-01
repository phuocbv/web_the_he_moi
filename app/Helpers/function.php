<?php
function cateParent($data, $parent = 0, $str = "--")
{
    foreach ($data as $value) {
        $id = $value->id;
        $name = $value->name;
        if ($value->parent_id == $parent) {
            echo "<option value='$id'>$str $name</option>";
            cateParent($data, $id, $str . "--");
        }
    }
}
