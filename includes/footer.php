<div id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; School 2018 All rights reserved </p>
            </div>
            <div class="col-md-6">
                <!-- <p class="pull-right"> <a href="#">Terms and conditions</a>  | <a href="#">Privacy</a></p> -->
            </div>
        </div>
    </div>
</div>
		
</div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript" src="alertifyjs/alertify.js"></script>
    

    <script src="js/moment.js"></script>
    <script src="js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="js/datatables.net/js/jquery.dataTables.js"></script>
    <script src="js/datatables.net-bs/js/dataTables.bootstrap.js"></script>
    <script src="js/datatables.net-keyTable/js/dataTables.keyTable.js"></script>
    <script src="js/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="js/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    
    <script src="js/assignment.js"></script>
    <script src="js/addTopic.js"></script>
    <script src="js/login.js"></script>
    <script src="js/email.js"></script>
    <script src="js/jquery.easypiechart.min.js"></script>
    <!-- dataTable -->
    <script>
        $(document).ready(function(){
            $('#datatable, #dataTable2, #dataTable3').dataTable();

            $('#datatable').DataTable({
            keys: true
            });

            $('#dataTable').DataTable();
            
        });
        
    </script>
    
    <!-- easychart -->
    <script>
      $(document).ready(function() {
        $('.chart').easyPieChart({
          easing: 'easeOutElastic',
          delay: 3000,
          barColor: '#4272d8',
          trackColor: '#fff',
          scaleColor: false,
          lineWidth: 20,
          trackWidth: 16,
          lineCap: 'butt',
          onStep: function(from, to, percent) {
            $(this.el).find('.percent').text(Math.round(percent));
          }
        });
      });
    </script>
    <!-- count js -->
    <script src="js/counterup/counterup.min.js"></script>
    <script>
        $('.counter').each(function() {
            var $this = $(this),

            countTo = $this.attr('data-count');

            $({ countNum: $this.text()}).animate({

                countNum: countTo

            },

            {
                duration: 900,
                easing:'linear',
                step: function() {
                $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                $this.text(this.countNum);
                }
            });  
        });
    </script>
    <!-- sidebar toggle -->
    <script>
        $(document).ready(function(){
            $('#togglesidebar').on('click',function(){
                
                $('#page-content').toggleClass('content-active');
                $('#sidebar').toggleClass('sidebar-active'); 
                $('#togglesidebar').toggleClass('animated swing');                   
            });
        }); 
    </script>    
</body>
</html>