<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Student;
use App\Form\StudentType;
use App\Entity\Classroom;
use App\Repository\StudentRepository;
use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Request;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index1()
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    /**
     * @Route("/classroomList", name="classroomList")
     */
    public function readClassroom()
    {
        $repository = $this->getDoctrine()->getRepository(Classroom::class);

        $classrooms = $repository->findAll();

        return $this->render('classroom/read.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }
    /**
     * @Route("/addClassroom", name="addClassroom")
     */

    public function addClassroom(Request $request)
    {
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class,$classroom);
        $form->add('Ajouter', SubmitType::class);
       
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $classroom = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('classroomList');        
            }
    return $this->render('classroom/newClassroom.html.twig', [
        'formA' => $form->createView(),
    ]);
}

      /**
     * @Route("/updateClassroom/{id}", name="updateClassroom")
     */
    public function updateClassroom(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $classroom = $em->getRepository(Classroom::class)->find($id);
        $form = $this->createForm(ClassroomType::class,$classroom);
        $form->add('Modifier', SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('classroomList');
        }    
        return $this->render("classroom/updateClassroom.html.twig", [
            "form" => $form->createView(),
        ]);
      
    }
    /**
    * @Route("/deleteClassroom/{id}", name="deleteClassroom")
     */
public function deleteClassroom( $id)
{
    $em = $this->getDoctrine()->getManager();
    $classe = $em->getRepository(Classroom::class)->find($id);
    $em->remove($classe);
    $em->flush();
    return $this->redirectToRoute("classroomList");
}
    /**
    * @Route("/classroomstudent1/{id}", name="classroominf1")
     */
public function classroomInfo1($id)
{
    $repository = $this->getDoctrine()->getRepository(Classroom::class);

        $classrooms = $repository->classroomInf1($id);

        return $this->render('classroom/list.html.twig', [
            'students' => $classrooms,
        ]);
}
 /**
    * @Route("/classroomslistDQL", name="classroomdql")
     */
    public function findAllClassroom1()
    {
        $em = $this->getDoctrine()->getManager();
        $q=$em->createQuery(
           "select c FROM App\Entity\Classroom c"
        );
        $r= $q->getResult();

        return $this->render('classroom/read.html.twig', [
            'classrooms' => $r,
        ]);
    }



    
}
