<?php

namespace Tests\Unit;

use App\Actions\ForgotPasswordAction;
use App\Actions\LoginAction;
use App\Actions\PasswordResetAction;
use App\Actions\RegisterAction;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->registerAction = new RegisterAction();
        $this->loginAction = new LoginAction();
        $this->forgotPasswordAction = new ForgotPasswordAction();
        $this->resetPasswordAction = new PasswordResetAction();
    }

//    public function test_register()
//    {
//        $data = [
//            'name' => 'James',
//            'surname' => 'Sirius',
//            'email' => rand(1, 1000) . 'james@gmail.com',
//            'password' => 'Password123!'
//        ];
//        $result = $this->registerAction->handle($data);
//
//        $this->assertContains('name', $result);
//    }
}
