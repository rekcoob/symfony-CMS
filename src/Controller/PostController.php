<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Service\{ FileUploader, Notification };
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
     * @param FileUploader $fileUploader
     * @param Notification $notification
     * @return Response
     */
    public function create(Request $request, FileUploader $fileUploader, Notification $notification)
    {
        // create a new post with title
        $post = new Post();
        
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // entity manager
            $entitymanager = $this->getDoctrine()->getManager();
            /** @var UploadedFile $file */
            $file = $request->files->get('post')['attachment'];
            if($file){
                $filename = $fileUploader->uploadFile($file);

                $post->setImage($filename);
                $entitymanager->persist($post);
                $entitymanager->flush(); 
            }
                        
            return $this->redirect($this->generateUrl('post.index'));
        }

        // return a response
        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
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

        $this->addFlash('success', 'Post was removed');
   
        // create the show view
        return $this->redirect($this->generateUrl('post.index'));
    }
}
