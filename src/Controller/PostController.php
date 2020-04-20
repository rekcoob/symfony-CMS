<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();
        
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        // create a new post with title
        $post = new Post();
        $post->setTitle('Post Three');

        // entity manager
        $entitymanager = $this->getDoctrine()->getManager();
        $entitymanager->persist($post);
        $entitymanager->flush();

        // return a response
        return $this->redirect($this->generateUrl('post.index'));
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {  
        // create the show view
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Post $post
     * @return Response
     */
    public function delete(Post $post)
    {
        // entity manager
        $entitymanager = $this->getDoctrine()->getManager();
        $entitymanager->remove($post);
        $entitymanager->flush();   
   
        // create the show view
        return $this->redirect($this->generateUrl('post.index'));
    }
}
