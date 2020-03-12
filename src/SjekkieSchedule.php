<?php

namespace SjekkieTime;

class SjekkieSchedule implements Sjekkieable
{
    private array $source;

    private string $template;

    public function __construct(array $source)
    {
        $this->source = $source;
        $this->template = $source['template'];
    }

    public function isSjekkieTime(): bool
    {
        if (array_key_exists('date', $this->source)) {
            try {
                return time() >= (new \DateTime($this->source['date']))->getTimestamp();
            } catch (\Exception $e) {
                return true; // Nou, tijd voor een sjekkie
            }
        }

        if (array_key_exists('times', $this->source)) {
            foreach ($this->source['times'] as $time) {
                $sjekkieNode = new SjekkieScheduleTimeNode($time);

                if ($sjekkieNode->isSjekkieTime()) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }
}
