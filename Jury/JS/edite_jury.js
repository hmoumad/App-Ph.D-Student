var ModalWrap1 = null;

//don't creat multiple modal
if(ModalWrap1 !== null){
  modal.remove();
}

const AddJury = (cin, nomF, prenomF, nomA, prenomA ) => {
    ModalWrap1 = document.createElement('div');
    ModalWrap1.innerHTML = `
        <div style=" background-color:rgba(0,0,0,0.5);" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div style="width:100%; height:100%; z-index: ; border-raduis:5px;" class="modal-content">
                    <div style="background-color: #D9FFFF; color: ; height: 65px;" class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Modifier</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="php/edite.php"  class="needs-validation" novalidate>
                        <div style="background-color: #DEDEDE" class="modal-body">
                            <div style="margin-top:0px;" class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="cinj" class="form-label">CIN :</label>
                                    <input style="text-align: center;" value="${cin}" style="margin-bottom: 20px;" id="cinj" name="CIN" type="text" class="form-control" placeholder="CIN" aria-label="First name" readonly>
                                </div>
                            </div>
                            <div style="margin-top:0px;" class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="nomf" class="form-label">Nom Français :</label>
                                    <input style="text-align: center;" value="${nomF}" style="margin-bottom: 20px;" id="nomf" name="nomF" type="text" class="form-control" placeholder="Nom Français" aria-label="First name" required>
                                </div>
                            </div>
                            <div style="margin-top:0px;" class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="prenomfr" class="form-label">Prénom Francais :</label>
                                    <input style="text-align: center;" value="${prenomF}" style="margin-bottom: 20px;" id="prenomfr" name="prenomF" type="text" class="form-control" placeholder="Prénom Francais" aria-label="First name" required>
                                </div>
                            </div>
                            <div style="margin-top:0px;" class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="nomarab" class="form-label">Nom Arab :</label>
                                    <input style="text-align: center;" value="${nomA}" style="margin-bottom: 20px;" id="nomarab" name="nomA" type="text" class="form-control" placeholder="Nom Arab" aria-label="First name">
                                </div>
                            </div>
                            <div style="margin-top:0px;" class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="prenomarab" class="form-label">Prénom Arab:</label>
                                    <input style="text-align: center;" value="${prenomA}" style="margin-bottom: 20px;" id="prenomarab" name="prenomA" type="text" class="form-control" placeholder="Prénom Arab" aria-label="First name">
                                </div>
                            </div>
                            

                        </div>
                        <div style="background-color: #D9FFFF;padding-bottom: 6px; padding-right: 15px; padding-top: 10px; height: 65px;" class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                            <button name="update" type="submit" class="btn btn-success">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    `;

    document.body.append(ModalWrap1);
    var modal = new bootstrap.Modal(ModalWrap1.querySelector('.modal'));
    modal.show();
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
}