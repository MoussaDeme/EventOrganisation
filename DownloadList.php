<?PHP
    set_include_path("./src");
    require_once('model/EventStorage.php');
    require_once("model/BdConnection.php");
    require_once("model/User.php");


  
  class DownloadList {

   private $bd;

   public function __construct($bd)
     {
       $this->bd = $bd;
     } 
    
  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  function excel(){
  $evenStorage = new EventStorage($this->bd);
  $list =array();
          foreach ($evenStorage->getUsersList() as $key => $value) {
            $list[]=array("nom" => $value->getFirstName(),"prenom" => $value->getLastName() ,"adresse" => $value->getAdress());
          }
  // file name for download
  $filename = "website_data_" . date('Ymd') . ".xls";

   header("Content-Disposition: attachment; filename=\"$filename\"");
   header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($list as $row) {
    if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, array($this, 'cleanData'));
    echo implode("\t", array_values($row)) . "\n";
  }
  }

}

$download = new DownloadList($bd);

$download->excel();

?>

