
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
       <script src="<?=base_url('assets/argon/')?>vendor/quill/dist/quill.min.js"></script>
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

        $( "#divtacit" ).hide(); 
        $( "#divtexplicit" ).hide();
      $("#tacit").on('click', function(){ 
        $( "#divtacit" ).show(); 
        $( "#divtexplicit" ).hide();
      }); 
      $("#Explicit").on('click', function(){   
        $( "#divtacit" ).hide(); 
        $( "#divtexplicit" ).show();
      }); 
   

      
    });

  $("#identifier").on("submit",function(){
      $("#hiddenArea").val($("#quillArea").html());
  })

  var $dtBasic = $('#datatable-basic2');


  // Methods

  function init($this) {

    // Basic options. For more options check out the Datatables Docs:
    // https://datatables.net/manual/options

    var options = {
      keys: !0,
      select: {
        style: "multi"
      },
      language: {
        paginate: {
          previous: "<i class='fas fa-angle-left'>",
          next: "<i class='fas fa-angle-right'>"
        }
      },
    };

    // Init the datatable

    var table = $this.on( 'init.dt', function () {
      $('div.dataTables_length select').removeClass('custom-select custom-select-sm');

      }).DataTable(options);
  }


  // Events

  if ($dtBasic.length) {
    init($dtBasic);
  }
  </script> 
</body>

</html>