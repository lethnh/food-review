<div>Bạn yêu cầu đổi mật khẩu </div>
<div>Vui lòng click đường dẫn bên dưới để thay đổi mật khẩu</div>
<div>
    <a
        href="{!! $url.'reset-password' . '?token='.$user->data->token_reset !!}">{{$url.'/auth/change-password/' . '?token='.$user->data->token_reset}}</a>
</div>