<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route ("/", name="home_page")
     */
    public function read(Request $request)
    {

        $posts = $this -> getDoctrine() -> getRepository(Post::class) ->findAll();

        return $this->render('post/index.html.twig', ['posts'=>$posts]);

    }

    /**
     * @Route ("/create", name="create")
     */
    public function create()
    {
        $request = Request::createFromGlobals();
        $text = $request -> get('text');

        if($text)
        {
            $entityManager = $this -> getDoctrine() -> getManager();
            $post = new Post;
            $post -> setText($text);

            $entityManager -> persist($post);
            $entityManager -> flush();

            return $this -> redirectToRoute('home_page');
        }


        return $this -> render('post/add.html.twig');
    }
    /**
     * @Route ("/update/{id}", name="update")
     */
    public function update(int $id)
    {
        $entityManager = $this -> getDoctrine() -> getManager();
        $post = $entityManager -> getRepository(Post::class) -> find($id);

        $request = Request::createFromGlobals();
        $updatedText = $request -> get('text');


        if(isset($post) && isset($updatedText))
        {
            $post ->setText($updatedText);
            $entityManager -> flush();
            return $this -> redirectToRoute('home_page');
        }

        return $this -> render('post/update.html.twig', ['post'=>$post]);
    }

    /**
     * @Route ("/delete/{id}", name="delete")
     */

    public function delete($id)
    {
        $entityManager = $this -> getDoctrine() -> getManager();
        $post = $entityManager -> getRepository(Post::class) -> find($id);

        if($post)
        {
            $entityManager -> remove($post);
            $entityManager -> flush();
            return $this -> redirectToRoute('home_page');
        }

        return $this -> redirectToRoute('home_page');
    }



}