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
use Doctrine\ORM\Mapping\Entity;


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
        if($salary<0)
        {
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
        //echo $_SERVER['REQUEST_URI'];
        $request = Request::createFromGlobals();
        // echo $request->getPathInfo();
        // echo $request->request->get('Name');
        // echo $request->server->get('HTTP_HOST');
        // echo $request->getMethod();
       print_r($request->getLanguages());
        return new JsonResponse($_POST);
    } 
    /**
     * @Route("/getdetails")
     */
    public function getdetails(EntityManagerInterface $em)
    {
       return $this->render('webpages\getdetails.html.twig',[]);
    }
    /**
     * @Route("/findout")
     */
    public function findout(EntityManagerInterface $em){
        $data=$_POST['btnid'];
       
        switch($data)
        {
            case 'maxsal':
            {
                $RAW_QUERY = 'SELECT max(salary) FROM salarytable';
                $result=$this->preparedquery($RAW_QUERY,$em);
                $return= $result[0]['max(salary)'];   
                break;
            }
            case 'minsal':
            {
                $RAW_QUERY = 'SELECT min(salary) FROM salarytable';
                $result=$this->preparedquery($RAW_QUERY,$em); 
                $return= $result[0]['min(salary)']; 
                break;
            }
            case 'avgsal':
            {
                $RAW_QUERY = 'SELECT avg(salary) FROM salarytable';
                $result=$this->preparedquery($RAW_QUERY,$em);
                $return= $result[0]['avg(salary)'];    
                break;
            }
            case 'highlypaidemp':
            {
                $RAW_QUERY = 'select name from salarytable where salary=(select max(salary) from salarytable)';
                $result=$this->preparedquery($RAW_QUERY,$em);
                $return=$this->getoutputofnamearray($result);
                
                break; 
            }
            case 'leastpaidemp':
            {
                $RAW_QUERY = 'select name from salarytable where salary=(select min(salary) from salarytable)';
                $result=$this->preparedquery($RAW_QUERY,$em);
                $return=$this->getoutputofnamearray($result);
                break; 
            }
        }
        return new JsonResponse($return);
    }   
    public function preparedquery($RAW_QUERY,$em)
    {
        
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;   
    }
    public function getoutputofnamearray($result)
    {
        $return="'";
        for($i=0;$i<sizeof($result);$i++)
        {
            if($i==0)
            {
                $return=$return.$result[$i]['name'];
            }
            else
            $return=$return." & ".$result[$i]['name'];
            
        }
        $return=$return."'";
        return $return;
    }
}
?>