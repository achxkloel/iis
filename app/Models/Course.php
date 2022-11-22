<?php

namespace App\Models;

class Course
{
    public int $id;

    public string $shortcut, $name, $guarantor;

    public function __construct($id, $shortcut, $name, $guarantor) {
        $this->id = $id;
        $this->shortcut = $shortcut;
        $this->name = $name;
        $this->guarantor = $guarantor;
    }
}
