<?php

namespace App\Http\Controllers;

use App\Models\Course;

class StudiesOverviewController
{
    public function get(): array {
        $first = new Course("IJA", "Seminar Java", "Name Surname");
        $second = new Course("IIS", "Informacni systemy", "Name Surname");
        $third = new Course("ITU", "Tvorba uzivatelskych rozhrani", "Name Surname");
        $fourth = new Course("IJC", "Jazyk C", "Name Surname");

        return array($first, $second, $third, $fourth);
    }
}
