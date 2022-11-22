<?php

namespace App\Http\Controllers;

use App\Models\Course;

class HomepageController
{
    public function get(): array {
        $first = new Course(0, "IJA", "Seminar Java", "Name Surname");
        $second = new Course(1, "IIS", "Informacni systemy", "Name Surname");
        $third = new Course(2, "ITU", "Tvorba uzivatelskych rozhrani", "Name Surname");
        $fourth = new Course(3, "IJC", "Jazyk C", "Name Surname");

        return array($first, $second, $third, $fourth, $first, $second, $third, $fourth, $first, $second, $third, $fourth, $first, $second, $third, $fourth,
        $first, $second, $third, $fourth, $first, $second, $third, $fourth, $first, $second, $third, $fourth);
    }
}
