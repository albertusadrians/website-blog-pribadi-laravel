<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Albertus Adrian Susanto',
            'username' => 'Adrian',
            'email' => 'adrian@gmail.com',
            'password' => bcrypt('admin')
        ]);

        User::factory(3)->create();

        // User::create([
        //     'name' => 'Antonius Felix Susanto',
        //     'email' => 'felix@gmail.com',
        //     'password' => bcrypt('admin')
        // ]);

        Category::create([
            'category_name' => 'Web Programming',
            'category_slug' => 'web-programming'
        ]);

        Category::create([
            'category_name' => 'Web Design',
            'category_slug' => 'web-design'
        ]);
        
        Category::create([
            'category_name' => 'Personal',
            'category_slug' => 'personal'
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.',
        //     'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta ea adipisci tenetur repellendus ipsam harum possimus ut, tempora vitae nisi voluptatem dolore numquam provident dolorem illum repellat doloremque minima similique illo voluptate at molestiae placeat mollitia delectus! At, earum. Quae enim non et, rem neque molestias nam alias commodi expedita cupiditate saepe itaque eaque error facere eum nemo deserunt ut impedit adipisci eius fugit voluptate! Ullam suscipit perferendis ex perspiciatis, libero hic enim consequatur nihil animi nemo itaque nostrum nulla, repudiandae dicta aspernatur molestias quidem. Assumenda aliquid et delectus unde quo laborum voluptatem, pariatur, reiciendis nesciunt veritatis neque, fugit molestiae.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.',
        //     'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta ea adipisci tenetur repellendus ipsam harum possimus ut, tempora vitae nisi voluptatem dolore numquam provident dolorem illum repellat doloremque minima similique illo voluptate at molestiae placeat mollitia delectus! At, earum. Quae enim non et, rem neque molestias nam alias commodi expedita cupiditate saepe itaque eaque error facere eum nemo deserunt ut impedit adipisci eius fugit voluptate! Ullam suscipit perferendis ex perspiciatis, libero hic enim consequatur nihil animi nemo itaque nostrum nulla, repudiandae dicta aspernatur molestias quidem. Assumenda aliquid et delectus unde quo laborum voluptatem, pariatur, reiciendis nesciunt veritatis neque, fugit molestiae.',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.',
        //     'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta ea adipisci tenetur repellendus ipsam harum possimus ut, tempora vitae nisi voluptatem dolore numquam provident dolorem illum repellat doloremque minima similique illo voluptate at molestiae placeat mollitia delectus! At, earum. Quae enim non et, rem neque molestias nam alias commodi expedita cupiditate saepe itaque eaque error facere eum nemo deserunt ut impedit adipisci eius fugit voluptate! Ullam suscipit perferendis ex perspiciatis, libero hic enim consequatur nihil animi nemo itaque nostrum nulla, repudiandae dicta aspernatur molestias quidem. Assumenda aliquid et delectus unde quo laborum voluptatem, pariatur, reiciendis nesciunt veritatis neque, fugit molestiae.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
