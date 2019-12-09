<?php
/**
 * Created by PhpStorm.
 * User: ducchien
 * Date: 28/11/2018
 * Time: 16:02
 */

namespace App\Listeners\SendMail;

use App\Events\RegisterEvent;
use App\Services\Email\SendEmail;

class RegisterSuccessListener
{
    protected $email;
    /**
     * Create the event listener.
     *
     * @return void
     */

    /**
     * sendBookingAdminListener constructor.
     *
     * @param SendEmail $email
     */
    public function __construct(SendEmail $email)
    {
        $this->email = $email;
    }


    /**
     *
     * @author HarikiRito <nxh0809@gmail.com>
     *
     * @param BookingEvent $event
     *
     * @throws \Exception
     */
    public function handle(RegisterEvent $event)
    {
        $this->email->mailRegister($event);
    }
}
