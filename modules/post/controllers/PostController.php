<?php

class PostController extends Controller {

    public function index() {
        Helper_Post::log();
        $posts = Model_Post::all();
        return $this->_view($posts);
    }

    public function add() {
        $post = null;

        if (is_post) {
            $post = null;

            try {
                $post = $this->_data(new Post()); //carrega os dados e preenche o objeto Post
                $post->Date = time();
                $post->save();
                $this->_flash('success', 'Post salvo com sucesso');
                $this->_redirect('~/post/');
            } catch (ValidationException $e) {
                $this->_flash('error', $e->getMessage());
            } catch (Exception $e) {
                $this->_flash('error', 'Ocorreu um erro ao tentar salvar o post.');
            }

            $this->_set('model', $post);
        }

        return $this->_view();
    }

    public function edit($id) {
        $post = Post::get((int) $id);
        if ($post) {
            if (is_post) {
                try {
                    $post = $this->_data($post);
                    $post->save();
                    $this->_flash('success', 'Post salvo com sucesso');
                    $this->_redirect('~/post/');
                } catch (ValidationException $e) {
                    $this->_flash('error', $e->getMessage());
                } catch (Exception $e) {
                    $this->_flash('error', 'Ocorreu um erro ao tentar salvar o post.');
                }
            }
            return $this->_view('add', $post);
        }
        return $this->_snippet('notfound');
    }

    public function delete($id) {
        $post = Post::get($id);
        if ($post) {
            try {
                $this->_flash('success', 'Post removido com sucesso.');
                $post->delete();
            } catch (Exception $e) {
                $this->_flash('error', 'Ocorreu um erro ao tentar remover o post.');
            }
            $this->_redirect('~/post/');
        }
        return $this->_snippet('notfound');
    }

}