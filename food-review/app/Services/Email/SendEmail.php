<?php

namespace App\Services\Email;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;


class SendEmail
{

    /**
     * @param Email  $email
     * @param string $template
     *
     * @return bool
     * @throws \Exception
     */
    public function mailRegister($data, $template = 'auth.register')
    {
        $email = $data->data['email'];
        $url = config('app.url');
        try {
            Mail::send($template, ['data' => $data, 'url' => $url], function ($message) use ($email) {
                $message->from('taikhoan150do@gmail.com');
                $message->to($email)->subject('Food Review - Đăng ký tài khoản thành công');
            });
        } catch (\Exception $e) {
            logs('emails', 'Email xác nhận gửi thất bại ' . $email);
            throw $e;
        }
    }

    public function sendMailResetPassword($user, $template = 'auth.passwords.reset')
    {


        $account_sid = 'ACb6184dafc83afc1e2d0048c3721869c5';
        $auth_token = '22b968cd719a5428c32e73006b43d00e';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+15054272967";
        $numbers_in_arrays = ['+84395555301', '+84866933113', '+84986966861', '+84976126185', '+84357702383'];
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            "+84395555301",
            array(
                'from' => $twilio_number,
                'body' => 'I L U'
            )
        );
        $timeSubmit                = Carbon::now()->timestamp;
        $user->data->timeSubmit    = base64_encode($timeSubmit);
        $email                     = $user->data->email;
        $url                       = env('APP_URL');
        try {
            Mail::send($template, ['user' => $user, 'url' => $url], function ($message) use ($email) {
                $message->from('taikhoan150do@gmail.com');
                $message->to('taikhoan150do@gmail.com')->subject('Food Review - Khôi phục mật khẩu');
            });
        } catch (\Exception $e) {
            logs('emails', 'Email gửi thất bại ' . $email);
            throw $e;
        }
    }

    /**
     *
     * @author ducchien0612 <ducchien0612@gmail.com>
     *
     * @param $user
     * @param string $template
     * @throws \Exception
     */
    public function setPassword($user, $template = 'email.setPassword')
    {
        $timeSubmit                = Carbon::now()->timestamp;
        $user->data->timeSubmit    = base64_encode($timeSubmit);
        $email                     = $user->data->email;
        $url                       = $this->getUrl($user->data->type);

        try {
            Mail::send($template, ['user' => $user, 'url' => $url], function ($message) use ($email) {
                $message->from(env('MAIL_TEST'));
                $message->to($email)->subject('Gisoft- Thiết lập mật khẩu!');
            });
        } catch (\Exception $e) {
            // dd($e);
            logs('emails', 'Email gửi thất bại ' . $email);
            throw $e;
        }
    }

    /**
     *
     * @author ducchien0612 <ducchien0612@gmail.com>
     *
     * @param $user
     * @return mixed
     */
    public function getUrl($type)
    {
        switch ($type) {
            case User::USER:
                $url = env('API_URL_CUSTOMER');
                break;
            case User::MERCHANT:
                $url = env('API_URL_MERCHANT');
                break;
            case User::ADMIN:
                $url = env('API_URL');
                break;
        }

        return $url;
    }

    public function notifyUnlock($user, $template = 'backend.emails.unlock')
    {

        $email = $user->data->email;

        try {
            Mail::send($template, ['user' => $user,], function ($message) use ($email) {
                $message->from('ducchien0612@gmail.com');
                $message->to($email)->subject('Gisoft - Tài khoản của bạn đã được mở khóa');
            });
        } catch (\Exception $e) {
            // dd($e);
            logs('emails', 'Email gửi thất bại ' . $email);
            throw $e;
        }
    }
}
