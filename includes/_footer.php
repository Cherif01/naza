<div class="m-5 p-5"></div>
<hr>
<footer>
    <div class="footer clearfix mb-0 text-muted text-center">
        <div class="float-start">
            <p><?= date("Y") ?> &copy; S.P.A</p>
        </div>
        <div class="float-end">
            <p>Created <span class="text-danger"><i class="bi bi-heart"></i></span> BY : <a target="_blank" href="https://www.spa-dev.com">S.P.A - TECHNOLGY</a></p>
        </div>
    </div>
</footer>
</div>
</div>
<script src="<?= LINK ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= LINK ?>assets/js/bootstrap.bundle.min.js"></script>

<script src="<?= LINK ?>assets/vendors/apexcharts/apexcharts.js"></script>
<script src="<?= LINK ?>assets/js/pages/dashboard.js"></script>

<script src="<?= LINK ?>assets/js/main.js"></script>

<script src="<?= LINK ?>assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let maTable = document.querySelector('#maTable');
    let dataTable = new simpleDatatables.DataTable(maTable);
</script>

<script src="<?= LINK ?>assets/script.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // toastr.success('Message de succès avec une barre de progression et une icône!');
    // toastr.error('Error')
</script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage =urlParams.get('success');
    const errorMessage =urlParams.get('error');
    if(successMessage){
        toastr.success(successMessage);
    }
    if(errorMessage){
        toastr.error(errorMessage);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.22/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
   function deleteAlert(id, url) {
      Swal.fire({
         title: "Are you sure?",
         text: "You won't be able to revert this!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: "Yes, delete it!"
      }).then((result) => {
         if (result.isConfirmed) {
            Swal.fire({
               title: "Deleted!",
               text: "Your file has been deleted.",
               icon: "success"
            });
            window.location.href = url + id
         }
      });

   }
</script>   
</body>

</html>