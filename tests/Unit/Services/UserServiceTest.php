<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = new UserService();

    }

//    public function testIndex() {
//
//        $response = $this->service->index();
//
//        $this->assertContains();
//    }
//
//    public function testStore() {
//
//        $result = $this->service->store();
//
//        $this->assertJson($result);
//    }
//
//    public function testShow() {
//
//        $result = $this->service->show();
//
//        $this->assertJson($result);
//    }
//
//    public function testUpdate() {
//
//        $data = [
//
//        ];
//
//        $result = $this->service->update($data);
//
//        $this->assertJson($result);
//    }

    public function testDestroy() {

        $user = User::factory()->create();

        $this->service->destroy($user);

        $this->assertModelMissing($user);
    }
}
