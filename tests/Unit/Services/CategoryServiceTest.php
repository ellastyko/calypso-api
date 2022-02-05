<?php

namespace Tests\Unit\Services;

use App\Models\Category;
use App\Services\CategoryService;
use PHPUnit\Framework\TestCase;

class CategoryServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = new CategoryService();
    }

//    public function testIndex() {
//
//        $data = [
//            'length' => 5,
//            'order' => 'created',
//            'direction' => 'asc',
//        ];
//
//        $result = $this->service->index($data);
//
//        $this->assertIsArray($result);
//    }

//    public function testStore() {
//
//        $result = $this->service->store();
//
//        $this->assertJson($result);
//    }

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
//
//    public function testDestroy() {
//
//        $category = Category::factory()->create();
//
//        $result = $this->service->destroy($category);
//
//        $this->assertModelMissing($result);
//    }
}
