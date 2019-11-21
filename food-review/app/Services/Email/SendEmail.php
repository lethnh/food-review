<?php

namespace App\Services\Email;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmail
{

    /**
     * @param Email  $email
     * @param string $template
     *
     * @return bool
     * @throws \Exception
     */
    public function mailConfirm($data, $template = 'emails.auth.confirm')
    {
        $email = $data->data['email'];
        $url = env('APP_URL');
        try {
            Mail::send($template, ['data' => $data, 'url' => $url], function ($message) use ($email) {
                $message->from('ducchien0612@gmail.com');
                $message->to($email)->subject('Gisoft - Xác thực tài khoản');
            });
        } catch (\Exception $e) {
            logs('emails', 'Email xác nhận gửi thất bại ' . $email);
            throw $e;
        }
    }

    public function sendMailResetPassword($user, $template = 'emails.auth.reset_password')
    {
        $timeSubmit                = Carbon::now()->timestamp;
        $user->data->timeSubmit    = base64_encode($timeSubmit);
        $email                     = $user->data->email;
        $url                       = env('APP_URL');
        try {
            Mail::send($template, ['user' => $user, 'url' => $url], function ($message) use ($email) {
                $message->from(env('MAIL_USERNAME'));
                $message->to($email)->subject('GISOFT - Khôi phục mật khẩu');
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
