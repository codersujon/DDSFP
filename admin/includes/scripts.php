        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        
        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- jquery.vectormap map -->
        <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>
        <script src="assets/js/sweetalert.min.js"></script>

         <!-- Datatable init js -->
         <script src="assets/js/pages/datatables.init.js"></script>

         <script src="assets/js/pages/form-validation.init.js"></script>
         <script src="assets/libs/select2/js/select2.min.js"></script>


         <?php 
            if(isset($_SESSION['status']) && $_SESSION['status'] !=""){ ?>

            <script>
                swal({
                    title: "<?php echo $_SESSION['status']; ?>",
                    text: "<?php echo $_SESSION['msg']; ?>",
                    icon: "<?php echo $_SESSION['status']; ?>",
                    timer: 800,
                });
            </script>

            <?php
                    unset($_SESSION['status']);
            }
         ?>

       

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
    </body>

</html>


      

        

       