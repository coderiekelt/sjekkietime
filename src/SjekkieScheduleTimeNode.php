<?php

namespace SjekkieTime;

class SjekkieScheduleTimeNode implements Sjekkieable
{
    private int $fromTime;

    private int $toTime;

    public function __construct(array $source)
    {
        $date = date('Y-m-d');

        try {
            $this->fromTime = (\DateTime::createFromFormat('Y-m-d H:i:s', $date . ' ' . $source['from']))->getTimestamp();
            $this->toTime = (\DateTime::createFromFormat('Y-m-d H:i:s', $date .  ' ' . $source['to']))->getTimestamp();
        } catch (\Exception $e) {
            die('Tijd voor een sjekkie, dit is stuk.');
        }
    }

    public function isSjekkieTime(): bool
    {
        return (time() >= $this->fromTime) && (time() <= $this->toTime);
    }
}
