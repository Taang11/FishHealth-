<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        // Validate reCAPTCHA v3 separately (needs the request IP)
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     * Override to add reCAPTCHA v3 verification before creating the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // First run standard validation
        $this->validator($request->all())->validate();

        // Then verify reCAPTCHA v3
        $token = $request->input('g-recaptcha-response');
        if (!$this->verifyRecaptchaV3($token, $request->ip())) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Verifikasi keamanan gagal. Silakan coba lagi.',
            ]);
        }

        // Fire registered event and redirect
        $this->registered($request, $user = $this->create($request->all()));

        return redirect($this->redirectPath());
    }

    /**
     * Verify a reCAPTCHA v3 token against Google's API.
     * Returns true if the token is valid and the score meets the threshold.
     *
     * @param  string|null  $token
     * @param  string       $ip
     * @return bool
     */
    private function verifyRecaptchaV3(?string $token, string $ip): bool
    {
        $secret    = config('services.recaptcha.v3_secret');
        $threshold = (float) config('services.recaptcha.threshold', 0.5);

        // Skip verification in local/testing env when no key is configured
        if (empty($secret) || $secret === 'your_v3_secret_key_here') {
            return true;
        }

        if (empty($token)) {
            \Log::warning('reCAPTCHA v3 token is empty while secret key is configured.');
            return false;
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secret,
                'response' => $token,
                'remoteip' => $ip,
            ]);

            $data = $response->json();

            return ($data['success'] ?? false) && ($data['score'] ?? 0) >= $threshold;
        } catch (\Exception $e) {
            \Log::warning('reCAPTCHA v3 verification failed: ' . $e->getMessage());
            return false;
        }
    }

    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'user', // default role
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (\Exception $e) {
            // Silently fail or log the error
            \Log::error('Gagal mengirim email welcome: ' . $e->getMessage());
        }
    }
}
