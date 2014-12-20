<?php

class RegisterController extends \BaseController {

	/**
     *
     * 进入注册页面
     *
	 */
	public function getRegister()
	{
		return View::make('register.information');
	}

    /**
     *
     *
     *处理注册信息
     *
     */
    public function postRegister()
    {
        $email              = Input::get('email');
        $password           = Input::get('password');
        $nickname           = Input::get('nickname');
        $firstname          = Input::get('firstname');
        $lastname           = Input::get('lastname');
        $gender             = Input::get('gender');

        $data               = array(
            'email'         => $email,
            'password'      => $password,
            'nickname'      => $nickname,
            'firstname'     => $firstname,
            'lastname'      => $lastname,
            'gender'        => $gender
        );
        $rules              = array(
            'email'         => 'required|email',
            'password'      => 'required|min: 6',
            'nickname'      => 'required|min: 3',
            'firstname'     => 'required',
            'lastname'      => 'required',
            'gender'        => 'required'
        );

        $validator          = Validator::make($data, $rules);

        if (Request::ajax()){

            if($validator->passes()) {

                $user1      = User::where('email', '=', $email)->first();
                $user2      = User::where('nickname', '=', $nickname)->first();

                if($user1 || $user2){

                    return Response::json(['success'=>false, 'errors'=>'email/昵称已存在，请重新输入!']);
                }

                $code       =md5($nickname);

                $user       = User::create(array(

                    'email'     => $email,
                    'password'  => Hash::make($password),
                    'nickname'  => $nickname,
                    'first_name' => $firstname,
                    'last_name'  => $lastname,
                    'gender'    => $gender,
                    'code'      => $code
                ));

                if($user) {

                   Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username'=> $nickname), function($message) use ($user) {
                        $message->to($user->email, $user->nickname)->subject('账号激活');
                    });

                    return Response::json(['success'=>true, 200]);
                }

            }
            else
            {
                    return Response::json(['success'=>false, 'errors'=>$validator->getMessageBag()->first()]);
            }
        }

    }

    /**
     *
     *激活页面处理
     *
     *
     */
     public function getActivate($code) {

        $user                   = User::where('code', '=', $code)->first();

        if($user){

            if($user->active == 1) {
                return Redirect::to('/')
                        ->with('setErrors', '该用户已被激活!');
            }
            else
            {
                $user->active   = 1;
                $user->code     = '';

                if($user->save()){
                    return Redirect::to('/')
                        ->with('setErrors','成功激活!');
                }
                else
                {
                    return Redirect::to('/')
                        ->with('setErrors','未知错误!');
                }
            }
        }
        else
        {
            return Redirect::to('/')
                        ->with('setErrors','用户不存在，请确认使用正确的链接！');
        }
     }

}
