$(document).ready(function(){

    /**
     *
     *防止csrf攻击的token
     *
     */

    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').attr('value')
            }
        });
    });




    /**
     *
     *email找回password邮箱表单提交
     *
     */
    $('#retrieveSubmit').click(function(e){
        e.preventDefault();

        email       = $('#retrieveEmail').val();
        url         = $('#retrieveForm').attr('action');

        $.ajax({

            type:   'post',
            url:    url,
            data:   'email='+email,
            success:function(data){
                if(data.success == true){
                    alert('邮件已发送，请查收！');
                    window.location = '/';
                }
                else
                {
                    alert(data.errors);
                }
            }
        });

    });

    /*
     *
     *email找回password修改密码表单提交
     *
     */
    $('#changePasswordSubmit').click(function(e){
        e.preventDefault();

        password            = $('#changePassword').val();
        password_confirm    = $('#passwordConfirm').val();
        code                = $('#change_code').attr('value');
        url                 = $('#changePasswordForm').attr('action');

        if(password != password_confirm) {

            alert('密码不一致，请重新输入！');

        }
        else
        {
            $.ajax({

                type:   'post',
                url:     url,
                data:   'password='+password+'&code='+code,
                success:function(data) {
                    if (data.success) {
                        alert('修改成功!');
                        window.location = '/';
                    }
                    else
                    {
                        alert(data.errors);
                    }
                }
            });
        }
    });

    /*
     *
     *注册过程的ajax函数
     *
     */

    $('#registerSubmit').click(function(e){
        e.preventDefault();

        email               = $('#registerEmail').val();
        password            = $('#registerPassword').val();
        password_confirm    = $('#registerPasswordConfirm').val();
        nickname            = $('#registerNickname').val();
        firstname           = $('#registerFirstname').val();
        lastname            = $('#registerLastname').val();
        gender              = $('#registerGender').prop('checked') ? 1 : 0;
        url                 = $('#registerForm').attr('action');

        if(password !== password_confirm) {

            alert('密码不一致，请重新输入!');
        }
        else
        {

            $.ajax({

                type:   'post',
                url:    url,
                data:   'email='+email+'&password='+password+'&nickname='+nickname+'&firstname='+firstname+'&lastname='+lastname+'&gender='+gender,
                success:function(data){
                    if(data.success) {
                        alert('邮件已发送，请及时查收!');
                        window.location = '/';
                    }
                    else
                    {
                        alert(data.errors);
                    }
                }
            });

        }

    });

    /**
     *
     *Comment提交过程处理
     *
     */
    $('#commentSubmit').click(function(e){
        e.preventDefault();

        Message         = $('textarea#Message').val();
        post_id         = $('#post_information').val();
        url             = $('form#commentForm').attr('action');

        $.ajax({
            type:   'post',
            url:    url,
            data:   'Message='+Message+'&post_id='+post_id,
            success:function(data){
                if(data.success){
                    window.location = '/posts/'+post_id;
                }
                else{
                    alert(data.errors);
                }
            }

        });
    });
});
