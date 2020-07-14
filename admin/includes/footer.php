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
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../alertifyjs/alertify.js"></script>
    

    <script src="js/moment.js"></script>
    <script src="../js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../js/datatables.net/js/jquery.dataTables.js"></script>
    <script src="../js/datatables.net-bs/js/dataTables.bootstrap.js"></script>
    <script src="../js/datatables.net-keyTable/js/dataTables.keyTable.js"></script>
    <script src="../js/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../js/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../js/jquery.easypiechart.min.js"></script>
    <script src="js/indexDataRetrival.js"></script>
    <script src="js/events.js"></script>
    <script src="js/exam.js"></script>
    <script src="js/timetable.js"></script>
    <script src="js/parents.js"></script>
    <script src="js/class.js"></script>
    <script src="js/subject.js"></script>
    <script src="js/teacher.js"></script>
    <script src="js/student.js"></script>
    <script src="js/attendance.js"></script>
    <script src="js/assignment.js"></script>
    <script>
        $(document).ready(function(){
            $('#datatable, #dataTable2, #dataTable3').dataTable();

            $('#datatable').DataTable({
            keys: true
            });

            $('#dataTable').DataTable();
        });
    </script>
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