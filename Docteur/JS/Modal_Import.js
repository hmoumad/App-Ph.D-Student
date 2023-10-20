var ModalWrap = null;

//don't creat multiple modal
if(ModalWrap !== null){
  modal.remove();
}

const ImportExcelFile = (title, description, value, btnyes, btnNO) => {
    ModalWrap = document.createElement('div');
    ModalWrap.innerHTML = `
    <div style=" background-color:rgba(0,0,0,0.5);" class="modal fade"id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div style="width:100%; height:100%; z-index: ; border-raduis:5px;" class="modal-content">
            <div style="background-color: #D9FFFF; color: ; height: 65px;" class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Importer</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div style="background-color: #DEDEDE" class="modal-body">
                   
                        <div class="mb-3">
                            <label for="formFile" class="form-label"><b>choisissez le fichier excel(.xlsx)</b></label>
                            <input name="excel" style="background-color: #FFB2DC;" class="form-control" type="file" id="formFile" required value="aucun fichier choisi"/>
                        </div>
                </div>
                <div style="background-color: #D9FFFF;padding-bottom: 6px; padding-right: 15px; padding-top: 10px; height: 65px;" class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button name="import" type="submit" class="btn btn-primary">Importer</button>
                </div>
            </form>
                
                
        </div>
    </div>
</div>
    `;

    document.body.append(ModalWrap);
    var modal = new bootstrap.Modal(ModalWrap.querySelector('.modal'));

    // valider ci les inputs est vide
    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
    })()
    modal.show();
}