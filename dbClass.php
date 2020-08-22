<?php


require_once("bilgi.php");
class DbBaglan{
     private $db = NULL ;
      function __construct() {
      $host = HOST ;
      $tablo = DB_NAME ;
      $kullanici = DB_USER ;
      $sifre = DB_PASSWORD ;
      $db = '';
      try{
         $this->$db = new PDO("mysql:host=".$host.";dbname=".$tablo.";charset=utf8", $kullanici, $sifre);
         } catch ( PDOException $e ){
          print $e->getMessage();
          die();
         }
   }

}

class DbSorgu extends DbBaglan {

   function c($tablo,$where = null){
         $db = '';
         if($where != null){
            $tablo .= " where $where"  ;
         }
         $sorgu = $this->$db->query("SELECT * FROM ".$tablo)->fetchall(PDO::FETCH_ASSOC);
         return $sorgu ;
   }

   function co($tablo,$where = null){
      $db = '';
     if($where != null){
       $tablo .= " where $where"  ;
     }
     $sorgu = $this->$db->query("SELECT * FROM ".$tablo)->fetchall(PDO::FETCH_OBJ);
     return $sorgu ;
   }

   function t($tablo,$where = null){
   $db = '';
     if($where != null){
       $tablo .= " where $where"  ;
     }
     $sorgu = $this->$db->query("SELECT * FROM ".$tablo)->fetch(PDO::FETCH_ASSOC);
     return $sorgu ;
   }

   function to($tablo,$where = null){
      $db = '';
     if($where != null){
       $tablo .= " where $where"  ;
     }
     $sorgu = $this->$db->query("SELECT * FROM ".$tablo)->fetch(PDO::FETCH_OBJ);
     return $sorgu ;
   }

   function say($tablo,$where = 0){
     $db= '';
     $c = "";
     $d = null;
     if($where){
       $c = "WHERE ";
       $d = array();
       foreach ($where as $a => $b) {
         if($c != "WHERE "){ $c.=" and "; }
          $c .= $a." = :x".$a;
          $d[":x".$a] = $b; 
       }
     }
     $query =  $this->$db->prepare("SELECT COUNT(*) FROM ".$tablo." ".$c);
     $query->execute($d);
     return $query->fetchColumn();
   }
}

class DbIslem extends DbBaglan {

   function Insert($tablo,$veriler){
        $db = NULL;
        $set = "SET ";
        foreach ($veriler as $a => $b) {
          $set.= $a."=:".$a.", ";
        }
        $set = rtrim($set,", ");
        global $db;
        $query = $this->$db->prepare("INSERT ".$tablo." ".$set);
        $update = $query->execute($veriler);
        if ($update){return true;}else{return false;}
   }

   function Update($tablo,$veriler,$id){
         $set = "SET ";
         $s = new DbSorgu(t($tablo,'id='.$id));
         if($s){  
         foreach ($veriler as $a => $b) {
            $set.= $a."=:".$a.", ";
         }
         $set = rtrim($set,", ");
         $query = $this->$db->prepare("UPDATE ".$tablo." ".$set." WHERE id='".$id."'");
         $update = $query->execute($veriler);
         if ($update){return true;}else{return false;}
         }
   }


}


$dbSorgula  = new DbSorgu();
$dbIslem    = new DbIslem();


?>