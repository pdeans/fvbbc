<?php

class PostCommentSeeder extends Seeder {

    public function run()
    {
        $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Praesent vel ligula scelerisque, vehicula dui eu, fermentum velit.
                    Phasellus ac ornare eros, quis malesuada augue. Nunc ac nibh at mauris dapibus fermentum.
                    In in aliquet nisi, ut scelerisque arcu. Integer tempor, nunc ac lacinia cursus,
                    mauris justo volutpat elit,
                    eget accumsan nulla nisi ut nisi. Etiam non convallis ligula. Nulla urna augue,
                    dignissim ac semper in, ornare ac mauris. Duis nec felis mauris.';

        $names = array(
            'Jimmy', 'James', 'Doug', 'Pete', 'Brian', 'Max', 'Nick', 'Brent', 'Aaron', 'Tony', 'Tim', 'Zack', 'Peter', 'Jack', 'Mike', 'Robert', 'Jesus', 'Jeff', 'Shaun', 'Adrian', 'Donald', 'Yolo', 'Clark', 'Johnson', 'Jennings', 'Rudd', 'Peterson', 'Foxx', 'Moseling', 'Renaux', 'Porter', 'Way', 'Bunn', 'Rummel', 'Sterling', 'Stone', 'Lambert', 'Lenaldo', 'Tuttle', 'Wilson', 'Washington', 'Swag', 'Brentwood', 'Parker', 'Kent', 'Shuttlesworth');
        $max = count($names) - 1;

        for( $i = 1 ; $i <= 30 ; $i++ )
        {
            $index = mt_rand(0, $max);
            $post = new Post;

            $post->title = "Post no $i";
            $post->read_more = substr($content, 0, 120);
            $post->content = $content;
            $post->posted_by = $names[$index] . mt_rand(1,999);
            $post->save();

            $maxComments = mt_rand(0,12);
            for( $j = 1 ; $j <= $maxComments; $j++)
            {
                $index = mt_rand(0, $max);
                $comment = new Comment;

                $comment->commenter = $names[$index] . mt_rand(1,999);
                $comment->comment = substr($content, 0, mt_rand(25, 120));
                $comment->approved = 1;
                $post->comments()->save($comment);
                $post->increment('comment_count');
            }
        }
    }

}
