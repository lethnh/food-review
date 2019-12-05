<p>Tài khoản của bạn đăng ký với chúng tôi đã thành công</p>
<p>Vui lòng nhấn vào link dưới đây để kích hoạt tài khoản: <strong>{!! $data->data['email'] !!}</strong></p>
<p><a href="{{$url.'/register-confirm'.'?token=' . $data->data['token']}}">Kích hoạt tài khoản</a></p>