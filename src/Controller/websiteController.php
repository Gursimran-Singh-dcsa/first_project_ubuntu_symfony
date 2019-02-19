<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Test;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Salarytable;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\HttpFoundation\Request;


class websiteController extends AbstractController{
    /**
     * @Route("/")
     */
    public function homepage(){
       return $this->render('webforms/salary.html.twig',[]);
    
    }
    /**
     * @Route("/save")
     */
    public function save(EntityManagerInterface $em){
        $return="";
        $name=$_POST['Name'];
        $salary=$_POST['salary'];
        if(strlen($name)==0 || preg_match("^[a-z A-Z*]^",$name)==0 )
        {
            echo preg_match("^[a-z A-Z*]^",$name);
            echo "name block";
            $return="$return error in name";
            return new JsonResponse($return);
        }
        if(gettype($salary)!='integer'||gettype($salary)!='double')
       {
           if($salary>0)
           {
               echo "salry must not be string<br>";
           }
           echo gettype($salary);
           echo "salary block";
        $return="invalid salary type";
        return new JsonResponse($return);
       }
        $pf=($salary*12)/100;
        $diff=$pf-(int)($pf);
       
        if($diff>.5)
        {
            $modifiedpf=(int)($pf)+1;
        }
        else{
            $modifiedpf=(int)($pf);
        }
        try{
        $home=$salary-$modifiedpf;
        $Salarytable = new Salarytable();
        $Salarytable->setName($name);
        $Salarytable->setPf($modifiedpf);
        $Salarytable->setSalary($salary);
        $Salarytable->setTakehomepay($home);
        $em->persist($Salarytable);
        $em->flush();
        $return="success";
        }
        catch(\Doctrine\DBAL\DBALException $ex)
        {
            
            $return="failed Due to Some Error";
        }
        return new JsonResponse($return);
    }
  /**
   * @Route("trypanga")
   */
    public function trypanga()
    {
       // print_r($_POST);
       $request = Request::createFromGlobals();
       echo $request->query->get("Name");
        return new JsonResponse($_POST);
    } 
}
?>