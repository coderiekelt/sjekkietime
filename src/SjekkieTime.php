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

        die('<center><h1>nee :(</h1></center>');
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
