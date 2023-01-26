<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\FavoriteController;
use Mockery;
use PHPUnit\Framework\TestCase;

class FavoriteControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     * @runInSeparateProcess
     * @return void
     */
    public function test_is_favorite()
    {
        $favoriteController = new FavoriteController();

        // モック

        $mock = Mockery::mock('alias:App\Models\Favorite');
        $mock->shouldReceive('where->where->exists')->andReturn((object)[
          'user_id' => 1,
          'note_id' => 33
        ]);

        // trueになる処理
        $result = $favoriteController->isFavorite(1, 33);
        $this->assertTrue($result);

        // falseになる処理
        $result = $favoriteController->isFavorite(1, 1);
        $this->assertFalse($result);
    }
}
