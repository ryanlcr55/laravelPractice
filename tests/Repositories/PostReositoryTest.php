<?php

use Tests\TestCase;
use App\User;
use App\Repositories\PostRepository;

// 一樣要先繼承
class PostRepositoryTest extends TestCase
{
    /**
     * @var PostRepository
     */
    protected $repository = null;

    // setUp 每執行一次 test case 前都會執行
    // 可以用來初始化資料庫並重新建立待測試物件
    // 以免被其他 test case 影響測試結果
    protected function setUp(): void
    {
        // 一定要先呼叫，建立 Laravel Service Container 以便測試
        parent::setUp();

        // 每次都要初始化資料庫
        $this->initDatabase();

        // 假 User
        $user = new User();
        $user->id = 1;
        $this->be($user);

        // 建立要測試用的 repository4
        $this->repository = new PostRepository();

        $this->seedData();
    }

    // tearDown 會在每個 test case 結束後執行
    // 可以用來重置相關環境
    protected function tearDown(): void
    {
        // 結束一個 test case 都要重置資料庫
        $this->resetDatabase();
        $this->repository = null;
    }

    /**
     * 建立 100 筆假文章
     */
    protected function seedData()
    {
        for ($i = 1; $i <= 100; $i++) {
            $this->repository->create([
                'title' => 'title ' . $i,
                'content' => 'body ' . $i,
            ]);
        }
    }

    public function testFetchLatest10Posts()
    {
        // 從 repository 中取得最新 10 筆文章
        $posts = $this->repository->latest10();
        $this->assertEquals(10, count($posts));

        // 確認標題是從 100 .. 91 倒數
        // "title 100" .. "title 91"
        $i = 100;
        foreach ($posts as $post) {
            $this->assertEquals('title ' . $i, $post->title);
            $i -= 1;
        }
    }
}
