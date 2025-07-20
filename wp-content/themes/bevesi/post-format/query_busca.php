<?php

echo 'author_meta'.the_author_meta('ID');
echo 'author_meta2'.$post->post_author;
$value= 0 ;


print_r($post);
exit;

if(!in_array($value, $user_id_post, true)){
    array_push($user_id_post, $value);
}

?>