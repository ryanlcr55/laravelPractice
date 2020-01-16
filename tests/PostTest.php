<?php

use Tests\TestCase;
use App\Entities\Post;

class PostTest extends TestCase
{
    // setUp 每執行一次 test case 前都會執行
    // 可以用來初始化資料庫並重新建立待測試物件
    // 以免被其他 test case 影響測試結果
    protected function setUp(): void
    {
        // 一定要先呼叫，建立 Laravel Service Container 以便測試
        parent::setUp();

        // 每次都要初始化資料庫
        $this->initDatabase();
    }

    // tearDown 會在每個 test case 結束後執行
    // 可以用來重置相關環境
    protected function tearDown(): void
    {
        // 結束一個 test case 都要重置資料庫
        $this->resetDatabase();
    }

    // 測試如果文章為空
    public function testEmptyResult()
    {
        // 取得所有文章
        $posts = Post::all();

        // 確認 $articles 是 Collection
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $posts);

        // 而文章數為 0
        $this->assertEquals(0, count($posts));
    }
}
