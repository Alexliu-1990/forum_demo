<?php

class UserController extends \BaseController {

	/**
     * 显示登录页面
     * * GET /user
	 *
	 * @return Login View
	 */
	public function getLogin()
	{
		return View::make('login.login');
    }

    /**
     *
     *登录信息处理
     *
     */

    public function postLogin()
    {
        $email                  = Input::get('email');
        $password               = Input::get('password');
        $rememberMe             = Input::get('checkbox');

        $data = array(
            'email'             => $email,
            'password'          => $password
        );

        $rules= array(
            'email'             => 'required|email',
            'password'          => 'required'
        );

        $validator              = Validator::make($data, $rules);

        if(Request::ajax()){


            if($validator->passes()){

                if(Auth::viaRemember()){

                    return Response::json(['success'=>true, 200]);

               } else {

                    if($rememberMe == 0){

                        if(Auth::attempt(array('email'=>$email, 'password'=>$password, 'active'=>1))){

                            return Response::json(['success'=>true, 200]);

                        } else {

                            return Response::json(['success'=>false, 'errors'=>'请检查您的登录信息']);
                        }
                    } else {

                         if(Auth::attempt(array('email'=>$email, 'password'=>$password, 'active'=>1), true)){

                            return Response::json(['success'=>true, 200]);

                        } else {

                            return Response::json(['success'=>false, 'errors'=>'请检查您的登录信息']);
                        }

                    }
               }

            } else {

                    return Response::json(['success'=>false, 'errors'=>'请检查您的登录信息']); //可以用$validator->getMessageBag()->toArray()给出更详细的error
            }
        }
    }

    /**
     *
     *密码找回页面
     *
     *
     */

    public function getForgot() {

        return View::make('login.forgot');
    }

    /**
     *
     *密码找回处理
     *
     *
     */

    public function postForgot() {

        $email                  = Input::get('email');

        $data                   = array('email' => $email);
        $rules                  = array('email' => 'required|email');

        $validator              = Validator::make($data, $rules);

        if(Request::ajax()){

            if($validator->passes()){

                $user = User::where('email', '=', $email)->first();

                if($user) {

                    $user_id    = $user->id;
                    $code       = md5($user_id);

                    $user->code = $code;

                    if($user->save()){

                        Mail::send('emails.auth.recover', array('link' => URL::route('forgot-password', $code), 'username' => $user->nickname), function($message) use ($user) {
                            $message->to($user->email, $user->nickname)->subject('请及时修改您的密码！');
                        });



                        return Response::json(['success'=>true, 200]);
                    }
                }
                else
                {
                    return Response::json(['success'=>false, 'errors'=>'邮箱不存在，请重新输入!']);
                }
            }
            else
            {
                return Response::json(['success'=>false, 'errors'=>'格式有误，请重新输入！']);

            }
        }
    }

    /*
     *
     *修改密码页面
     *
     */

    public function getForgotPassword($code) {

        $user           = User::where('code', '=', $code)->first();

        if($user) {

            return View::make('login.change-password')->with('code', $code);

        }
        else
        {
            return Redirect::to('/');
        }
    }

    /**
     *
     *修改密码表单提交
     *
     */

    public function postForgotPassword() {

        $code                   = Input::get('code');
        $password               = Input::get('password');

        $data                   = array('password' => $password);
        $rules                  = array('password' => 'required|min: 6');
        $validator              = Validator::make($data, $rules);

        $user                   = User::where('code', '=', $code)->first();

        if(Request::ajax()){
            if($validator->passes()){
                if($user && ($user->active == 1)) {

                    $user->code     = '';
                    $user->password = Hash::make($password);

                    if($user->save()) {

                        return Response::json(['success' => true, 200]);
                    }
                }
                else
                {
                    return Response::json(['success' => false, 'errors' => '请确认您的输入信息！']);
                }
            }
            else
            {
                return Response::json(['success' => false, 'errors' => '密码长度要大于6位！']);
            }
        }
    }

    /*
     *
     *注销函数
     *
     */

    public function getLogout() {

        Auth::logout();
        return Redirect::to('/');
    }
}
