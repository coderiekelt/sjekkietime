<?php

namespace SjekkieTime;

class SjekkieTime
{
    /** @var SjekkieSchedule */
    private array $schedules;

    private string $directory;

    public function serve($schedule)
    {
        if ($this->schedules[$schedule]->isSjekkieTime()) {
            die(file_get_contents($this->directory . '/templates/' . $this->schedules[$schedule]->getTemplate()));
        }

        die('<center><img src="https://st2.depositphotos.com/1049184/6926/i/950/depositphotos_69269213-stock-photo-sad-man-in-scarf-have.jpg" alt="Nee" style="height: 100%;"></center>');
    }

    public function load(string $directory) {
        $this->directory = $directory . '/../';

        foreach (scandir($directory) as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            $this->schedules[str_replace('.json', '', $file)] =
                new SjekkieSchedule(json_decode(file_get_contents($directory . '/' . $file), true));
        }
    }
}
