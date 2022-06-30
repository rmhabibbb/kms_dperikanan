
      <!-- Footer --> 
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?=base_url('assets/argon/')?>vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/js-cookie/js.cookie.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="<?=base_url('assets/argon/')?>vendor/chart.js/dist/Chart.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  
    <!-- Jquery DataTable Plugin Js -->
     
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>vendor/datatables.net-select/js/dataTables.select.min.js"></script>
  <script src="<?=base_url('assets/argon/')?>js/argon.js?v=1.1.0"></script> 


  <script src="<?=base_url('assets/argon/')?>js/demo.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#email").keyup(function(){  
        var email = $("#email").val();   
        $cek1 = 0;
          $.ajax({ 
            url:"<?php echo base_url(); ?>superadmin/cekemail",
            method:"post", 
            data:{email:email},
                success:function(data){     
                if (data != ""){ 
                  cek1 = 0 ;
                  $('#pesan1_pgw').html(data); 
                }else {
                  $('#pesan1_pgw').html(data); 
                  cek1 = 1 ;
                }   
              }
          });  
      }); 
 
      $("#formgpw").keyup(function(){  

        $cek1 = 0;
        $cek2 = 0;
        $cek3 = 0;
        var password = $("#passwordold").val();  
          if (password != '') {
            $.ajax({ 
              url:"<?php echo base_url(); ?>superadmin/cekpasslama",
              method:"post", 
              data:{password:password},
                  success:function(data){     
                  if (data != ""){ 
                    cek1 = 0 ;
                    $('#pesan2_pgw').html(data); 
                  }else {
                    $('#pesan2_pgw').html(data); 
                    cek1 = 1 ;
                  }   
                }
            });  
          }else{  
            $('#pesan2_pgw').html('Password is required!');   
          } 

          var password = $("#passwordnew").val();  
          if (password != '') {
            $.ajax({ 
              url:"<?php echo base_url(); ?>superadmin/cekpass",
              method:"post", 
              data:{password:password},
                  success:function(data){     
                  if (data != ""){ 
                    cek2 = 0 ;
                    $('#pesan3_pgw').html(data); 
                  }else {
                    $('#pesan3_pgw').html(data); 
                    cek2 = 1 ;
                  }  
                  if (cek1 == 0 || cek2 == 0 || cek3 == 0  ) {
                     $(':input[name="gpw"]').prop('disabled', true);
                  } else {
                     $(':input[name="gpw"]').prop('disabled', false);
                  }  
                }
            });  
          } 

          var password2 = $("#passwordnew2").val();   
            $.ajax({ 
              url:"<?php echo base_url(); ?>superadmin/cekpass2",
              method:"post", 
              data:{password:password, password2:password2},
                  success:function(data){     
                  if (data != ""){ 
                    cek3 = 0 ;
                    $('#pesan4_pgw').html(data); 
                  }else {
                    $('#pesan4_pgw').html(data); 
                    cek3 = 1 ;
                  }  
                   
                }
            }); 

          if (cek1 == 0 || cek2 == 0 || cek3 == 0  ) {
             $(':input[name="gpw"]').prop('disabled', true);
          } else {
             $(':input[name="gpw"]').prop('disabled', false);
          }   
      }); 

      
    });
  </script>
  <script type="text/javascript">

  <?php if ($index == 1) { ?> 
    var BarsChart = (function() { 
      var $chart = $('#chart-bars-m'); 
      function initChart($chart) {

        // Create chart
        var ordersChart = new Chart($chart, {
          type: 'horizontalBar',
          data: { 
            labels: [<?php  foreach ($list_m as $row){ echo "'".$row->nama_lengkap."',"; } ?> ],
            datasets: [{
              label: 'Quantity',
              data: [<?php  foreach ($list_m as $row){ echo number_format($this->Voting_m->get_votes($row->id_peserta,$row->jk,$setting->akumulasi_vote, $setting->tahap_voting),0,'','.').", "; } ?>]
            }]
          }
        });

        // Save to jQuery object
        $chart.data('chart', ordersChart);
      } 
      if ($chart.length) {
        initChart($chart);
      } 
    })();

    var BarsChart = (function() { 
      var $chart = $('#chart-bars-f'); 
      function initChart($chart) {

        // Create chart
        var ordersChart = new Chart($chart, {
          type: 'horizontalBar',
          data: { 
            labels: [<?php  foreach ($list_f as $row){ echo "'".$row->nama_lengkap."',"; } ?> ],
            datasets: [{
              label: 'Quantity',
              data: [<?php  foreach ($list_f as $row){ echo number_format($this->Voting_m->get_votes($row->id_peserta,$row->jk,$setting->akumulasi_vote, $setting->tahap_voting),0,'','.').", "; } ?>]
            }]
          }
        });

        // Save to jQuery object
        $chart.data('chart', ordersChart);
      } 
      if ($chart.length) {
        initChart($chart);
      } 
    })();

    var DatatableButtons = (function() {

      // Variables

      var $dtButtons = $('#datatable-buttons2');


      // Methods

      function init($this) {

        // For more options check out the Datatables Docs:
        // https://datatables.net/extensions/buttons/

        var buttons = ['excel', 'pdf'];

        // Basic options. For more options check out the Datatables Docs:
        // https://datatables.net/manual/options

        var options = {

          lengthChange: !1,
          dom: 'Bfrtip',
          buttons: buttons,
           //select: {
            // style: "multi"
            //},
          language: {
            paginate: {
              previous: "<i class='fas fa-angle-left'>",
              next: "<i class='fas fa-angle-right'>"
            }
          }
        };

        // Init the datatable

        var table = $this.on( 'init.dt', function () {
          $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-sm btn-default');
          }).DataTable(options);
      }


      // Events

      if ($dtButtons.length) {
        init($dtButtons);
      }

    })();
 <?php } ?>

 <?php if ($index == 2) { ?>
    var SalesChart = (function() {

      // Variables

      var $chart = $('#chart-sales-voucher');


      // Methods

      function init($this) {
        var salesChart = new Chart($this, {
          type: 'line',
          options: {
            scales: {
              yAxes: [{
                gridLines: {
                  color: Charts.colors.gray[700],
                  zeroLineColor: Charts.colors.gray[700]
                },
                ticks: {

                }
              }]
            }
          },
          data: {
            labels: [<?php $date = $datestart;  for($i=1; $i <= $n_day+1; $i++){ echo '"'. date('d-m-Y', strtotime($date)) . ' " ,'; $date = date('Y-m-d',strtotime($date . "+1 days"))  ;  } ; ?>],
            datasets: [{
              label: 'Quantity',
              data: [<?php $date = $datestart;  for($i=1; $i <= $n_day+1; $i++){ echo  $this->Voting_m->get_voucher_by_date(date('Y-m-d',strtotime($date))) . ' ,'; $date = date('Y-m-d',strtotime($date . "+1 days"))  ;  } ; ?>]
            }]
          }
        });

        // Save to jQuery object

        $this.data('chart', salesChart);

      };


      // Events

      if ($chart.length) {
        init($chart);
      }

    })();



    $(document).ready(function(){
      var BarsChart = (function() { 
          var $chart = $('#chart-bars-v'); 
          function initChart($chart) {
            <?php if (isset($_GET['tgl_search'])) {
              $tgl = $_GET['tgl_search'];
            }else{
              $tgl = '';
            } ?>
         
            // Create chart
            var ordersChart = new Chart($chart, {
              type: 'bar',
              data: { 
                labels: [<?php $i = 1; foreach ($nominals as $row) { echo '"' . $row->nominal . '" , '; } ?> ],
                datasets: [{
                  label: 'Quantity',
                  data: [<?php $i = 1; foreach ($nominals as $row) { echo $this->Voting_m->get_count_voucher_by_nominaldate($row->nominal , $tgl) . ","; } ?>]
                }]
              }
            });

            // Save to jQuery object
            $chart.data('chart', ordersChart);
          } 

          if ($chart.length) {
            initChart($chart);
          }  
        })();
       
    });
 
 <?php } ?>

<?php if ($index == 3) { ?>
  var SalesChart = (function() {

      // Variables

      var $chart = $('#chart-sales-votes');


      // Methods

      function init($this) {
        var salesChart = new Chart($this, {
          type: 'line',
          options: {
            scales: {
              yAxes: [{
                gridLines: {
                  color: Charts.colors.gray[700],
                  zeroLineColor: Charts.colors.gray[700]
                },
                ticks: {

                }
              }]
            }
          },
          data: {
            labels: [<?php $date = $datestart;  for($i=1; $i <= $n_day+1; $i++){ echo '"'. date('d-m-Y', strtotime($date)) . ' " ,'; $date = date('Y-m-d',strtotime($date . "+1 days"))  ;  } ; ?>],
            datasets: [{
              label: 'Quantity',
              data: [<?php $date = $datestart;  for($i=1; $i <= $n_day+1; $i++){ echo  $this->Voting_m->get_votes_by_date(date('Y-m-d',strtotime($date))) . ' ,'; $date = date('Y-m-d',strtotime($date . "+1 days"))  ;  } ; ?>]
            }]
          }
        });

        // Save to jQuery object

        $this.data('chart', salesChart);

      };


      // Events

      if ($chart.length) {
        init($chart);
      }

    })();



    $(document).ready(function(){


        var BarsChart = (function() { 
          var $chart = $('#chart-bars-v'); 
          function initChart($chart) {

            <?php 
               $date = '';  
             ?> 
            // Create chart
            var ordersChart = new Chart($chart, {
              type: 'bar',
              data: { 
                labels: [<?php $i = 1; foreach ($nominals as $row) { echo '"' . $row->nominal . '" , '; } ?> ],
                datasets: [{
                  label: 'Quantity',
                  data: [<?php $i = 1; foreach ($nominals as $row) { echo $this->Voting_m->get_count_voucher_by_nominaldate($row->nominal , $date) . ","; } ?>]
                }]
              }
            });

            // Save to jQuery object
            $chart.data('chart', ordersChart);
          } 

          if ($chart.length) {
            initChart($chart);
          } 
        })();

    });
    
     var BarsChart = (function() { 
      var $chart = $('#chart-bars-m'); 
      function initChart($chart) {
        <?php if (isset($_GET['tgl_search'])) {
          $tgl = $_GET['tgl_search'];
        }else{
          $tgl = '';
        } ?>
        // Create chart
        var ordersChart = new Chart($chart, {
          type: 'horizontalBar',
          data: { 
            labels: [<?php  foreach ($list_m as $row){ echo "'".$row->nama_lengkap."',"; } ?> ],
            datasets: [{
              label: 'Quantity',
              data: [<?php  foreach ($list_m as $row){ echo number_format($this->Voting_m->get_vote_by_date($tgl,$row->id_peserta,$row->jk,$setting->akumulasi_vote, $setting->tahap_voting),0,'','.').", "; } ?>]
            }]
          }
        });

        // Save to jQuery object
        $chart.data('chart', ordersChart);
      } 
      if ($chart.length) {
        initChart($chart);
      } 
    })();

    var BarsChart = (function() { 
      var $chart = $('#chart-bars-f'); 
      function initChart($chart) {
        <?php if (isset($_GET['tgl_search'])) {
          $tgl = $_GET['tgl_search'];
        }else{
          $tgl = '';
        } ?>
        // Create chart
        var ordersChart = new Chart($chart, {
          type: 'horizontalBar',
          data: { 
            labels: [<?php  foreach ($list_f as $row){ echo "'".$row->nama_lengkap."',"; } ?> ],
            datasets: [{
              label: 'Quantity',
              data: [<?php  foreach ($list_f as $row){ echo number_format($this->Voting_m->get_vote_by_date($tgl,$row->id_peserta,$row->jk,$setting->akumulasi_vote, $setting->tahap_voting),0,'','.').", "; } ?>]
            }]
          }
        });

        // Save to jQuery object
        $chart.data('chart', ordersChart);
      } 
      if ($chart.length) {
        initChart($chart);
      } 
    })();

 <?php } ?>



<?php if ($index == 4) { ?>
  var SalesChart = (function() {

      // Variables

      var $chart = $('#chart-sales-trans');


      // Methods

      function init($this) {
        
        var salesChart = new Chart($this, {
          type: 'line',
          options: {
            scales: {
              yAxes: [{
                gridLines: {
                  color: Charts.colors.gray[700],
                  zeroLineColor: Charts.colors.gray[700]
                },
                ticks: {

                }
              }]
            }
          },
          data: {
            labels: [<?php $date = $datestart;  for($i=1; $i <= $n_day+1; $i++){ echo '"'. date('d-m-Y', strtotime($date)) . ' " ,'; $date = date('Y-m-d',strtotime($date . "+1 days"))  ;  } ; ?>],
            datasets: [{
              label: 'Quantity',
              data: [<?php $date = $datestart;  for($i=1; $i <= $n_day+1; $i++){ echo  $this->Voting_m->get_nominal_by_date(date('Y-m-d',strtotime($date))) . ' ,'; $date = date('Y-m-d',strtotime($date . "+1 days"))  ;  } ; ?>]
            }]
          }
        });

        // Save to jQuery object

        $this.data('chart', salesChart);

      };


      // Events

      if ($chart.length) {
        init($chart);
      }

    })();



  
 <?php } ?>



<?php if ($index == 5) { ?>
  var SalesChart = (function() {

      // Variables

      var $chart = $('#chart-sales-voter');


      // Methods

      function init($this) {
        var salesChart = new Chart($this, {
          type: 'line',
          options: {
            scales: {
              yAxes: [{
                gridLines: {
                  color: Charts.colors.gray[700],
                  zeroLineColor: Charts.colors.gray[700]
                },
                ticks: {

                }
              }]
            }
          },
          data: {
            labels: [<?php $date = $datestart;  for($i=1; $i <= $n_day+1; $i++){ echo '"'. date('d-m-Y', strtotime($date)) . ' " ,'; $date = date('Y-m-d',strtotime($date . "+1 days"))  ;  } ; ?>],
            datasets: [{
              label: 'Quantity',
              data: [<?php $date = $datestart;  for($i=1; $i <= $n_day+1; $i++){ echo  sizeof($this->Voting_m->get_voter_by_date(date('Y-m-d',strtotime($date)))) . ' ,'; $date = date('Y-m-d',strtotime($date . "+1 days"))  ;  } ; ?>]
            }]
          }
        });

        // Save to jQuery object

        $this.data('chart', salesChart);

      };


      // Events

      if ($chart.length) {
        init($chart);
      }

    })();



  
 <?php } ?>



</script>
</body>

</html>