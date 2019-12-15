<?php

namespace App\Services;

use Twilio\Rest\Client;

class Twilio
{

    public function sendSms()
    {
        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'ACb6184dafc83afc1e2d0048c3721869c5';
        $auth_token = '22b968cd719a5428c32e73006b43d00e';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+15054272967";
        $numbers_in_arrays = ['+840395555301','+840866933113','+840986966861','+840976126185','+840357702383'];
        $client = new Client($account_sid, $auth_token);
        foreach ($numbers_in_arrays as $number) {

            $client->messages->create(
                // Where to send a text message (your cell phone?)
                $number,
                array(
                    'from' => $twilio_number,
                    'body' => ''
                )
            );
        }
    }
}
