<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
   <a class="navbar-brand mr-auto mr-lg-0" href="#">Zadarma</a>
   <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
    
      </ul>
      <span class="text-white">Добро пожаловать, <?php print $vars['user']['login']; ?></span>
      <a href="./?controller=logout"><button class="btn text-white my-2 my-sm-0">Выйти</button></a>
   </div>
</nav>
<div class="modal fade" id="addContactModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Новый контакт</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="formAddContact" method="post">
               <div class="form-group">
                  <label for="inputFirstname" class="col-form-label">Имя</label>
                  <input type="text" name="firstname" class="form-control" id="inputFirstname" required>
               </div>
               <div class="form-group">
                  <label for="inputLastname" class="col-form-label">Фамилия</label>
                  <input type="text" name="lastname" class="form-control" id="inputLastname" required>
               </div>
               <div class="form-group">
                  <label for="inputPhone" class="col-form-label">Телефон</label>
                  <input type="number" name="phone" class="form-control" id="inputPhone" required>
               </div>
               <div class="form-group">
                  <label for="inputEmail" class="col-form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="inputEmail" required>
               </div>
               <div class="form-group">
                  <label for="inputPhoto" class="col-form-label">Фото</label>
                  <input type="file" name="photo" class="form-control" id="inputPhoto" accept="image/x-png,image/jpeg" required>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                  <button type="submit" class="btn btn-primary">Добавить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="editContactModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Редактирование контакта</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="formEditContact" method="post">
               <input type="hidden" id="inputIDEdit" name="id" value="">
               <div class="form-group">
                  <label for="inputFirstnameEdit" class="col-form-label">Имя</label>
                  <input type="text" name="firstname" class="form-control" id="inputFirstnameEdit" required>
               </div>
               <div class="form-group">
                  <label for="inputLastnameEdit" class="col-form-label">Фамилия</label>
                  <input type="text" name="lastname" class="form-control" id="inputLastnameEdit" required>
               </div>
               <div class="form-group">
                  <label for="inputPhoneEdit" class="col-form-label">Телефон</label>
                  <input type="number" name="phone" class="form-control" id="inputPhoneEdit" required>
               </div>
               <div class="form-group">
                  <label for="inputEmailEdit" class="col-form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="inputEmailEdit" required>
               </div>
               <div class="form-group">
                  <label for="inputPhotoEdit" class="col-form-label">Фото</label>
                  <input type="file" name="photo" class="form-control" id="inputPhotoEdit" accept="image/x-png,image/jpeg">
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                  <button type="submit" class="btn btn-primary">Сохранить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>