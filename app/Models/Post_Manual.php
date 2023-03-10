<?php

namespace App\Models;


class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Albertus Adrian",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas sit maiores ab dignissimos labore modi nemo nostrum fugiat ratione nobis illum, corporis vel iusto consectetur cum. Alias reiciendis fuga rem doloremque aut ducimus iusto quod, praesentium similique illum nam, eaque molestias autem laboriosam magnam exercitationem reprehenderit, officia dolorum aliquid facere assumenda esse suscipit. Nihil id minima quasi maiores veritatis blanditiis, amet dolor velit ipsum vel placeat accusamus, distinctio tenetur non aliquid facere quisquam quod aut illo nisi quos porro! Vel?"
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Antonius Felix",
            "body" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil aliquid fuga dignissimos eligendi nobis harum voluptate, cumque quibusdam assumenda reprehenderit numquam sequi esse eveniet doloribus delectus qui fugiat. Beatae quaerat ducimus nostrum voluptates, dolorum neque quasi delectus quod quidem cupiditate voluptatibus ad enim ullam qui, animi amet corrupti voluptate odio? Earum dolore corrupti expedita consectetur. Sit eaque aliquam facilis repellendus hic quaerat consequatur doloremque exercitationem aliquid minima? Optio quis sunt, inventore dicta consequuntur enim voluptate explicabo officia velit omnis deleniti. Placeat, voluptatibus veritatis? Nostrum, perferendis eos nesciunt autem explicabo illo laudantium itaque facere nemo, rem odio temporibus officiis corporis vitae!"
        ],
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        // $cur_post = [];
        // foreach ($posts as $post) {
        //     if ($post['slug'] === $slug) {
        //         $cur_post = $post;
        //     }
        // }
        return $posts->firstWhere('slug',$slug);
    }
}

