<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password'        => 'required|string',
        ]);

        // Verify reCAPTCHA v3 token
        $token = $request->input('g-recaptcha-response');
        if (!$this->verifyRecaptchaV3($token, $request->ip())) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Verifikasi keamanan gagal. Silakan coba lagi.',
            ]);
        }
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
            \Log::info('reCAPTCHA v3 verification request:', [
                'ip' => $ip,
                'token_preview' => substr($token, 0, 15) . '...',
                'secret_preview' => substr($secret, 0, 10) . '...'
            ]);

            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secret,
                'response' => $token,
                'remoteip' => $ip,
            ]);

            $data = $response->json();

            \Log::info('reCAPTCHA v3 verification response:', [
                'success' => $data['success'] ?? false,
                'score' => $data['score'] ?? null,
                'action' => $data['action'] ?? null,
                'error-codes' => $data['error-codes'] ?? null,
            ]);

            return ($data['success'] ?? false) && ($data['score'] ?? 0) >= $threshold;
        } catch (\Exception $e) {
            \Log::error('reCAPTCHA v3 verification exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * Redirect setelah login berdasarkan role.
     */
    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        return match($user->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'teknisi' => redirect()->route('teknisi.dashboard'),
            default   => redirect()->route('user.dashboard'),
        };
    }
}
