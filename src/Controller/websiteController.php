<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Test;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;


class websiteController extends AbstractController{
    /**
     * @Route("/")
     */
    public function homepage(){
       return $this->render('webforms/salary.html.twig',[]);
       
    }
  
}
?>