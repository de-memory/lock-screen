<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href="#">{{config('admin.name')}}</a>
    </div>

    <div class="text-center">{{ Admin::user()->name }}</div>

    <div class="lockscreen-item">

        <div class="lockscreen-image">
            <img src="{{ Admin::user()->getAvatar() }}" alt="User Image">
        </div>

        <form class="lockscreen-credentials" id="lock-screen-form" method="post"
              action="{{ admin_route('de-memory.lock-screen.unlock') }}">
            <div class="input-group">
                <input id="password" type="password" class="form-control" name="password"
                       placeholder="{{ trans('admin.password') }}">

                <div class="input-group-append">
                    <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>

                <br>
            </div>
        </form>
    </div>
    <div class="text-center">
        <a href="{{ admin_base_path('auth/logout') }}">{{ trans('admin.logout') }}</a>
    </div>
</div>
<script>
    Dcat.ready(function () {
        $('input').focus();

        $('#lock-screen-form').form({
            validate: true,
            error: function (response) {
                // 当提交表单失败的时候会有默认的处理方法，通常使用默认的方式处理即可
                var errorData = JSON.parse(response.responseText);

                if (errorData) {
                    Dcat.error(errorData.errors.password);
                } else {
                    console.log('提交出错', response.responseText);
                }

                // 终止后续逻辑执行
                return false;
            },
        });
    });
</script>

