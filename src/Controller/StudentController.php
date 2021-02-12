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
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    
     /**
     * @Route("/studentList", name="studentList")
     */
    public function readStudent()
    {
        $repository = $this->getDoctrine()->getRepository(Student::class);
        $students = $repository->findAll();

        return $this->render('student/read.html.twig', [
            'students' => $students,
        ]);
    }
    /**
     * @Route("/addStudent", name="addStudent")
     */
    public function addEtudiant(Request $request)
    {
        $student = new Student();     
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $student = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('studentList');
         }
    return $this->render('student/newEtudiant.html.twig', [
        'form' => $form->createView()
        
    ]);
}

      /**
     * @Route("/updateStudent/{id}", name="updateStudent")
     */

    public function updateStudent(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->find($id);
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('studentList');
        }
    
        return $this->render("Student/updateEtudiant.html.twig", [
            "form_title" => "Modifier un Etudiant",
            "form" => $form->createView(),
        ]);
      
    }
    /**
    * @Route("/deleteStudent/{id}", name="deleteStudent")
     */
public function deleteEtudiant( $id)
{
    $em = $this->getDoctrine()->getManager();
    $etudiant = $em->getRepository(Student::class)->find($id);
    $em->remove($etudiant);
    $em->flush();

    return $this->redirectToRoute("studentList");
}
 /**
    * @Route("/searchStudent", name="searchStudent")
     */
    public function searchEtudiant(Request $request )
    {

        $data = $request->get('search');
       
       $repository = $this->getDoctrine()->getRepository(Student::class);
       $students = $repository->findBy(['nsc' => $data]);
    return $this->render('student/search.html.twig', [
        'students' => $students,
     ]);
   
    }
       /**
    * @Route("/classroomStudents/{id}", name="classroomStudents")
     */
public function classroomStudents($id)
{
    $repository = $this->getDoctrine()->getRepository(Student::class);

        $students = $repository->classroomStudents($id);

        return $this->render('student/list.html.twig', [
            'students' => $students,
        ]);
}
    /**
     * @Route("/AllStudents", name="AllStudents")
     */
    public function AllStudents(Request $request, NormalizerInterface $Normalizer )
    {
        $repository = $this->getDoctrine()->getRepository(Student::class);
        $students = $repository->findAll();

        $jsonContent = $Normalizer->normalize($students, 'json',['groups'=>'post:read']);
        // return $this->render('student/allStudentJSON.html.twig', [
        //     'data'=> $jsonContent,
        //]);
        return new Response(json_encode($jsonContent));

    }

    /**
     * @Route("/addStudentJSON/new", name="addStudentJSON")
     */
    public function addStudentJSON(Request $request,NormalizerInterface $Normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $student = new Student();
        $student->setNsc($request->get('nsc'));
        $student->SetEmail($request->get('email'));
        $em->persist($student);
        $em->flush();
        $jsonContent = $Normalizer->normalize($student, 'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));;
    }

    /**
     * @Route("/updateStudentJSON/{nsc}", name="updateStudentJSON")
     */
    public function updateStudentJSON(Request $request,NormalizerInterface $Normalizer,$nsc)
    {

        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->find($nsc);
        $student->setNsc($request->get('nsc'));
        $student->SetEmail($request->get('email'));
        $em->flush();
        $jsonContent = $Normalizer->normalize($student, 'json',['groups'=>'post:read']);
        return new Response("Information updated successfully".json_encode($jsonContent));;
    }
    /**
     * @Route("/deleteStudentJSON/{nsc}", name="deleteStudentJSON")
     */
    public function deleteStudentJSON(Request $request,NormalizerInterface $Normalizer,$nsc)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->find($nsc);
        $em->remove($student);
        $em->flush();
        $jsonContent = $Normalizer->normalize($student, 'json',['groups'=>'post:read']);
        return new Response("Student deleted successfully".json_encode($jsonContent));
    }
}
