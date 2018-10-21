<?php

namespace App\Http\Controllers\Auth;

use App\Models\ActivationKey;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\ActivationKeyTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ActivationKeyController extends Controller
{
    use ActivationKeyTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['web']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $validator = Validator::make($data,
            [
                'email'                 => 'required|email',
            ],
            [
                'email.required'        => 'Email is required',
                'email.email'           => 'Email is invalid',
            ]
        );

        return $validator;

    }

    public function showKeyResendForm(){
        return view('auth.resend_key');
    }

    public function activateKey($activation_key)
    {
        // determine if the user is logged-in already
        if (Auth::check()) {
            if (auth()->user()->activated) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Your email is already activated.');
            }
        }

        // get the activation key and check if its valid
        $activationKey = ActivationKey::where('activation_key', $activation_key)
            ->first();

        if (empty($activationKey)) {
            return redirect()->route('login')
                ->withErrors('The provided activation key appears to be invalid.');
        }

        // process the activation key we're received
        $this->processActivationKey($activationKey);

        // redirect to the login page after a successful activation
        return redirect()->route('login')
            ->with('success', 'You successfully activated your email! You can now login');


    }

    public function resendKey(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $email      = $request->get('email');

        // get the user associated to this activation key
        $user = User::where('email', $email)
            ->first();

        if (empty($user)) {
            return redirect()->route('activation_key_resend')
                ->withErrors('We could not find this email in our system')
                ->withInput($request->input());
        }

        if ($user->activated) {
            return redirect()->route('activation_key_resend')
                ->with('success', 'This email address is already activated')
                ->withInput($request->input());
        }

        // queue up another activation email for the user
        $this->queueActivationKeyNotification($user);

        return redirect()->route('activation_key_resend')
            ->with('success', 'The activation email has been re-sent.')
            ->withInput($request->input());
    }
}
