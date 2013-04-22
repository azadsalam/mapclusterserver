<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mappoint extends CI_Controller {

    function index(){
        $points[0] = 0;
        $points[1] = 0;
        $points[2] = 2;
        $points[3] = 0;
        $points[4] = 2;
        $points[5] = 2;
        $points[6] = 0;
        $points[7] = 2;


        print_r($points);
        echo "<br/>";
        $points = json_encode($points,JSON_FORCE_OBJECT);

        /*
         {"19":"22288497,88727433","17":"22268164,88771379","18":"22268164,88727433","15":"22308827,89166886","33":"24426557,89518449","16":"22308827,88925187","13":"22390115,89650285","14":"22349477,89342668","11":"22633697,91012589","12":"22491660,90375382","21":"22795844,88925187","20":"22451051,88815324","22":"23220560,89144914","23":"23442494,89276750","24":"23563394,89386613","25":"23603668,89386613","26":"23643932,89408586","27":"23664058,89408586","28":"23704302,89408586","29":"23845058,89408586","3":"24686366,91298233","2":"24666400,90704971","1":"24626458,90199601","10":"22735062,91320206","0":"24586503,89606340","7":"23180169,91320206","30":"24045874,89474504","6":"23985662,91320206","5":"24426557,91320206","32":"24286439,89496476","4":"24686366,91320206","31":"24186259,89496476","9":"22755325,91320206","8":"22937564,91320206"}
         */


        $points = $this->findPoints($points);
        echo "<br/>";
        print_r($points);
    }

   public function checkPoints(){


        $json=$_SERVER['HTTP_JSON'];
        $data=json_decode($json);
        $points=$data->{'points'};

        //print_r($points);

        $points['points'] = $this->findPoints($points);
        print_r(json_encode($points,JSON_FORCE_OBJECT));
    }


    public function findPoints($polygon)
    {
        //$polygon  = json_decode($polygon,JSON_FORCE_OBJECT);


        $latitude=array();
        $longitude=array();
        $lat=0;
        $lon=0;
        for($i = 0; $i<count($polygon);$i++){
            if($i%2==0)$latitude[$lat++]=$polygon[$i];
            else $longitude[$lon++]=$polygon[$i];
        }

        /*
        echo "<br/>";
        print_r($latitude);
        echo "<br/>";
        print_r($longitude);
        */
        $count = count($latitude);
        $ret=array();

        $mid = ($count/2);

        for($i=0,$c=0; $i<$mid ; $i++)
        {
            $lat = (($latitude[$i] + $latitude[$i + $mid]) / 2000000);
            $lon = (($longitude[$i] + $longitude[$i + $mid])/2000000);

            $ret[$c++] = $lat;
            $ret[$c++] = $lon;
        }

        return json_encode($ret, JSON_FORCE_OBJECT);
    }
}