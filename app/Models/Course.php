<?php

namespace App\Models;

class Course
{
    public string $shortcut, $name, $guarantor;

    public function __construct($shortcut, $name, $guarantor) {
        $this->shortcut = $shortcut;
        $this->name = $name;
        $this->guarantor = $guarantor;
    }
}
