


    <!-- Jquery Core Js -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script>
    $(function() {
        function stripTrailingSlash(str) {
            if (str.substr(-1) == '/') {
                return str.substr(0, str.length - 1);
            }
            return str;
        }
        var url = window.location.pathname;
        var activePage = stripTrailingSlash(url);
        var activeLi = activePage.split("/")[1];
        
        $(".menu .list li[data-active]").each(function() {
          if ($(this).data("active") == activeLi) {
            $(this).addClass('active');
          }
        });
        
        $('.menu li a').each(function() {
            var currentPage = stripTrailingSlash($(this).attr('href'));
            
            if (activePage == currentPage) {
                $(this).parent().addClass('active');
            }
        });
    });
    </script>  
    <!-- Bootstrap Core Js -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.js"></script>
    
    <?php if (!empty($module["select_plugin"]) and $module["select_plugin"] == true) { ?>
      
      <!-- Bootstrap Select Js -->
      <script type="text/javascript" src="/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    
    <?php } ?>
    
    <?php if (!empty($module["dropzone_plugin"]) and $module["dropzone_plugin"] == true) { ?>
      
      <!-- Bootstrap Select Js -->
      <script type="text/javascript" src="/assets/plugins/dropzone/dropzone.js"></script>
      <script type="text/javascript">
        Dropzone.options.myAwesomeDropzone = {
          maxFiles: 1,
          autoProcessQueue: false,
          
          accept: function(file, done) {
            console.log("uploaded");
            done();
          },
          init: function() {
            this.on("maxfilesexceeded", function(file){
            });
            var submitButton = document.querySelector("#submit-all")
                myDropzone = this; // closure
        
            submitButton.addEventListener("click", function() {
              myDropzone.processQueue(); // Tell Dropzone to process all queued files.
            });
        
            // You might want to show the submit button only when 
            // files are dropped here:
            this.on("addedfile", function() {
              // Show submit button here and/or inform user to click it.
              alert("pepe");
            });

          }
        };
      </script>
    
    <?php } ?>

    <!-- Slimscroll Plugin Js -->
    <script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="/assets/plugins/node-waves/waves.js"></script>
    
    <?php if (!empty($module["chartjs_dashboard"]) and $module["chartjs_dashboard"] == true) { ?>    
      <!-- Chart Plugins Js -->
      <script src="/assets/plugins/chartjs/Chart.bundle.js"></script>
      <script type="text/javascript">
        $(function() {
            new Chart(document.getElementById("line_chart_users").getContext("2d"), {
                type: 'line',
                data: {
                    labels: [<?= $dashboard["dashboard_users_chart_js"]["labels"] ?>],
                    datasets: [{
                        label: "Total de usuarios",
                        data: [<?= $dashboard["dashboard_users_chart_js"]["data"] ?>],
                        borderColor: 'rgba(0, 188, 212, 0.75)',
                        backgroundColor: 'rgba(0, 188, 212, 0.3)',
                        pointBorderColor: 'rgba(0, 188, 212, 0)',
                        pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                        pointBorderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: false
                }
            });
            new Chart(document.getElementById("line_chart_products").getContext("2d"), {
                type: 'line',
                data: {
                    labels: [<?= $dashboard["dashboard_products_chart_js"]["labels"] ?>],
                    datasets: [{
                        label: "Total de productos",
                        data: [<?= $dashboard["dashboard_products_chart_js"]["data"] ?>],
                        borderColor: 'rgba(233, 30, 99, 0.75)',
                        backgroundColor: 'rgba(233, 30, 99, 0.3)',
                        pointBorderColor: 'rgba(233, 30, 99, 0)',
                        pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                        pointBorderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: false
                }
            });
        });
      </script>
    <?php } ?>
    
    <?php if (!empty($module["database_table_user"]) and $module["database_table_user"] == true) { ?>
      <!-- Jquery DataTable Plugin Js -->
      <script src="/assets/plugins/momentjs/moment-with-locales.js"></script>
      <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
      <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
      <script src="/assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
      <script src="/assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
      <script src="/assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
      <script src="/assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
      <script src="/assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
      <script src="/assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
      <script src="/assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    	<script type="text/javascript">
        $(function () {
            moment.locale('es-ES')
            $('.date_time').each(function() {
              var date_value = $( this ).text();
              var text = moment(date_value).format('LLLL');
              $(this).text(text);
            });
            
            //Exportable table
            $('.datatable_users').DataTable({
                language: {
                  "sProcessing":     "Procesando...",
                  "sLengthMenu":     "Mostrar _MENU_ usuarios",
                  "sZeroRecords":    "No se encontraron resultados",
                  "sEmptyTable":     "Ningún dato disponible en esta tabla",
                  "sInfo":           "Mostrando usuarios del _START_ al _END_ de un total de _TOTAL_ usuarios",
                  "sInfoEmpty":      "Mostrando usuarios del 0 al 0 de un total de 0 usuarios",
                  "sInfoFiltered":   "(filtrado de un total de _MAX_ usuarios)",
                  "sInfoPostFix":    "",
                  "sSearch":         "Buscar:",
                  "sUrl":            "",
                  "sInfoThousands":  ",",
                  "sLoadingRecords": "Cargando...",
                  "oPaginate": {
                      "sFirst":    "Primero",
                      "sLast":     "Último",
                      "sNext":     "Siguiente",
                      "sPrevious": "Anterior"
                  },
                  "oAria": {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
                },
                select: true,
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            
        });
    	</script>
    <?php } ?>

    <?php if (!empty($module["lightgallery_plugin"]) and $module["lightgallery_plugin"] == true) { ?>
      <!-- Light Gallery Plugin Js -->
      <script src="/assets/plugins/light-gallery/js/lightgallery-all.js"></script>
      <script type="text/javascript">
        $(function () {
          $("#user-thumbnials").lightGallery(); 
        });
      </script>
    <?php } ?>
    
    <?php if (!empty($module["datetimepicker_plugin"]) and $module["datetimepicker_plugin"] == true) { ?>
      <!-- Moment Plugin Js -->
      <script src="/assets/plugins/momentjs/moment-with-locales.js"></script>
      
      <!-- Bootstrap Material Datetime Picker Plugin Js -->
      <script src="/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <?php if (!empty($module["datetimepicker_plugin_edit_user"]) and $module["datetimepicker_plugin_edit_user"] == true) { ?>
          <script type="text/javascript">
            var user_datetimepicker = $('.user_datetimepicker').bootstrapMaterialDatePicker({
              lang: 'es_ES',
              format: 'dddd DD [de] MMMM [del] YYYY [a las] HH:mm',
              clearButton: true,
              weekStart: 1,
              currentDate: new Date($('.user_datetimepicker').data('value'))
            });

          </script>
      <?php } ?>
    <?php } ?>
    
    <!-- Validation Plugin Js -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="/assets/js/admin.js"></script>
    
    <!-- Demo Js -->
    <script src="/assets/js/demo.js"></script>
    
    <!-- Demo sign in -->
    <script src="/assets/js/pages/examples/sign-in.js"></script>

    <!-- Plugin del konami code -->
    <script src="/assets/plugins/konami-code-master/src/jquery.konami.js"></script>
    <script type="text/javascript">
      $( window ).konami({
    		cheat: function() {
    			alert( 'Cheat code activated!' );
    		}
    	});
    </script>
</body>
</html>