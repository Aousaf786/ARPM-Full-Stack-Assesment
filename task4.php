public function createPost($author_id, $title, $categoryId)  
{  
    // Check if the title already exists for the given author
    $existingPost = BlogPost::where('author_id', $author_id)
                             ->where('title', $title)
                             ->first();

    if ($existingPost) {  
        return "Title already exists.";  
    }  

    // Create a new blog post
    $post = new BlogPost;  
    $post->title = $title;  
    $post->author_id = $author_id;  
    $post->status = 'published';  
    $post->save();  

    // Attach the post to the specified category
    DB::table('post_categories')->insert([
        'post_id' => $post->id,
        'category_id' => $categoryId
    ]);  

    return "Post created successfully!";  
}
