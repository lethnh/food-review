<?php


namespace App\Events;


class RegisterEvent extends Event
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
}
