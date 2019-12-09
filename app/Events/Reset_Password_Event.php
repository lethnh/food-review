<?php


namespace App\Events;


class Reset_Password_Event extends Event
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

}