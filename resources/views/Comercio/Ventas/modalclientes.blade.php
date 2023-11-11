<style>
     .table-primary{
      border-collapse: collapse;
      margin: 20px 5px;
      min-width: 400px;
    }
    .table-primary thead th {
        background-color:#140a4d;
        text-align: left;
    }
    .table-primary th,
    .table-primary td{
        padding: 25px 15px;
    }
    /* En tu archivo CSS personalizado */
.modal-md {
    max-width: 45%; /* Ajusta el porcentaje según tus necesidades */
    margin: 0 auto; /* Centra el modal horizontalmente */
}

</style>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content ">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Seleccion de Subcliente</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ><span class="icon-exit">
            <i class="fa-solid fa-xmark" style="color: #da1b24;"></i></span></button>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <input placeholder="Search By Name or Email" type="text" class="form-control" id="search" name="search" />
          </div>
          <table class="table table-bordered table-hover " id="subclienteTableContainer">
            <thead>
              <tr>ID</tr>
              <tr>User Name</tr>
              <tr>Email</tr>
            </thead>
            <tbody id="searcli">
              
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Agregar Subcliente</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/d2f64cbda1.js" crossorigin="anonymous"></script>