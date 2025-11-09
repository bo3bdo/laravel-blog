<?php

test('the application redirects to posts index', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('posts.index'));
});
