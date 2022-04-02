<?php

namespace App\Actions;

use App\Events\ForgotPassword;
use Illuminate\Support\Facades\Password;

/**
 * Class ForgotPasswordAction
 */
class ForgotPasswordAction
{
    /**
     * @param array $data
     * @return string
     */
    public function handle(array $data): string
    {
        return Password::sendResetLink($data, fn ($user, $token) => ForgotPassword::dispatch($user, $token));
    }
}
