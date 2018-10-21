<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserType;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\ActivationKeyTrait;
use App\Helpers\LogToDatabase;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, ActivationKeyTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'username'              => 'required|unique:users|min:6',
            'given_name'            => 'required|max:255',
            'surname'               => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
            'user_type_id'          => 'required',
        ],
        [
            'username.required'     => 'Username is required',
            'username.min'          => 'Username needs to have at least :min characters',
            'username.unique'       => 'Username already registered',
            'given_name.required'   => 'Given Name is required',
            'given_name.max'        => 'Given Name max character is :max',
            'surname.required'      => 'Surname is required',
            'surname.max'           => 'Surname max character is :max',
            'email.required'        => 'Email is required',
            'email.email'           => 'Email is invalid',
            'email.max'             => 'Email maximum length is :max',
            'email.unique'          => 'Email already registered',
            'password.required'     => 'Password is required',
            'password.min'          => 'Password needs to have at least :min characters',
            'password.confirmed'    => 'Password and confirm password field value should match',
            'user_type_id.required' => 'User Type is required',
        ]);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'given_name' => $data['given_name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activated' => !config('settings.send_activation_email')  // if we do not send the activation email, then set this flag to 1 right away
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        // create the user
        $user = $this->create($request->all());

        $id = $user->id;
        $user = User::where('id', $id)->first();
        foreach($request->user_type_id as $user_type_id){
            $user->userTypes()->attach(UserType::where('id', $user_type_id)->first());
        }

        // process the activation email for the user
        $this->queueActivationKeyNotification($user);

        $message = 'User account created.';
        LogToDatabase::log(1, $message);


        if(!config('settings.send_activation_email')){
            $message = 'User successfully created.';
        } else {
            $message = 'An email containing an activation code has been sent to the email provided. Please ask the user to check his/her email.';
        }

        // we do not want to login the new user

        if(!config('settings.send_activation_email')){
            //No Email confirmation email is needed
            $message = 'User successfully registered.';
        } else {
            $message = 'An email containing an activation code has been sent to the email provided. Please ask the user to check his/her email.';
        }


        return redirect()->route('users.create')
            ->with('success', $message);
    }

//    public function showRegistrationForm()
//    {
//        return view('admin.users.users-create');
//    }
}
