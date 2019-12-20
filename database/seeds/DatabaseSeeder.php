<?php
use App\User;
use App\Model\Tag;
use App\Model\Post;
use App\Model\PostTag;
use App\Model\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // 创建一个用户
        $user = factory(User::class)->create([
            'name' => 'iwanli',
            'password' => bcrypt('123123')
        ]);
        // 创建四个分类
        factory(Category::class,4)->create()->each(function($category) use ($user){
            // 创建10片文章
            factory(Post::class, 10)->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
            ])->each(function($post){
                // 随机创建2-4个标签
                factory(Tag::class, rand(2,4))->create()->each(function($tag) use ($post){
                    // 添加文章和标签的关系
                    PostTag::create([
                        'post_id' => $post->id,
                        'tag_id' => $tag->id,
                    ]);
                });
            });
        });
    }
}
