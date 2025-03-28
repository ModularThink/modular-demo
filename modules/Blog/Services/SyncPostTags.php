<?php

namespace Modules\Blog\Services;

use Modules\Blog\Models\Post;

class SyncPostTags
{
    public function sync(Post $post, array $tags): void
    {
        if (! count($tags)) {
            $post->tags()->detach();

            return;
        }

        $data = [];
        foreach ($tags as $tag) {
            $data[] = [
                'blog_post_id' => $post->id,
                'blog_tag_id' => $tag['id'],
            ];
        }
        $post->tags()->sync($data);
    }
}
