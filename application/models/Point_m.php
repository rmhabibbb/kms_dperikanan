<?php 
class Point_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id';
    $this->data['table_name'] = 'point';
  }

  public function get_point($id){


  	$query = $this->db->query('SELECT SUM(`point`) as n FROM  `point` where id_pengguna = "' . $id . '"'   );
      return $query->row()->n; 

  }

  public function get_point_m($id,$m,$y){
    $query = $this->db->query('SELECT SUM(`point`) as n FROM  `point` where id_pengguna = "' . $id . '" and month(dt)="'.$m.'" and year(dt)="'.$y.'"'   );
      return $query->row()->n; 
  }

  public function get_trophy($id){

    $my = $this->db->query('SELECT month(dt) as m , year(dt) as y FROM `point` GROUP by month(dt),year(dt)')->result();



     $list_pengguna = $this->Pengguna_m->get();

    $trophy = array();

     foreach ($my as $a) {
      $point = array();
        foreach ($list_pengguna as $p) {

        
         $pp = $this->Point_m->get_point_m($p->id_pengguna, $a->m, $a->y);

         if (!$pp) {
           $pp = 0;
         }

         $data = [
            'point' => $pp,
            'nama' => $p->nama,
            'id' => $p->id_pengguna
         ];

         array_push($point, $data);
       }
       rsort($point);
       $i=1;
       foreach ($point as $po) { 
          if ($i <= 2) {
              $d = [
              'bulan' => $a->m,
              'tahun' => $a->y,
              'data' => $po,
              'rank' => $i 
            ];

            array_push($trophy, $d);
          
          }
          $i++;
       }
       
     }


     $hasil = array();
     foreach ($trophy as $t) {
       if ($t['data']['id'] == $id) {
         array_push($hasil, $t);
       }
     }
     

     
     
     return $hasil;
    
    
  }

}

 ?>
