<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\UniquePhoneNumber;
use App\Rules\ValidPhoneNumber;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input = $this->getInputFromRequest($request);
        $this->validator($input)->validate();

        $user = $this->find($input);

        if (! $user) {
            $user = $this->create($input);
        }

        Auth::login($user);

        return redirect('/');
    }

    /**
     * Pre-process request input
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function getInputFromRequest(Request $request): array
    {
        $phoneNumber = preg_replace('~\D~', '', $request->input('phone'));

        return [
            'phone' => $phoneNumber,
        ];
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => ['required', app()->make(ValidPhoneNumber::class)],
        ]);
    }

    /**
     * Find existing user from input data
     *
     * @param  array  $data
     * @return \App\User|null
     */
    protected function find(array $data): ?User
    {
        return User::where('phone', $data['phone'])
            ->first();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data): User
    {
        return User::create([
            'phone' => $data['phone'],
            'code' => $this->generateCode(),
        ]);
    }

    /**
     * Generate an unique 4 character code for a newly registered user
     *
     * @return string
     */
    private function generateCode(): string
    {
        do {
            $code = bin2hex(openssl_random_pseudo_bytes(2));
        } while (User::where('code', $code)->count() > 0);

        return $code;
    }
}
