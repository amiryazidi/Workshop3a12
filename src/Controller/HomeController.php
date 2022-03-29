<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/addStudent",name="studentAdd")
     */
    public function addStudent(Request $request)
    {
        $student= new Student();
        $form = $this->createForm(StudentType::class,$student);
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             $em= $this->getDoctrine()->getManager();
             $em->persist($student);
             $em->flush();
             return $this->redirectToRoute("studentAdd");
         }
        return $this->render("student/add.html.twig",array("formStudent"=>$form->createView()));
     }


}
