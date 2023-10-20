var ModalWrap1 = null;

//don't creat multiple modal
if(ModalWrap1 !== null){
  modal.remove();
}

const ModalAddDoctor = (identifiant,cne,cin,noma,prenoma,nomf,prenomf,datenaissance,liueA,liueF,formation,etablissement,specialite) => {
    ModalWrap1 = document.createElement('div');
    ModalWrap1.innerHTML = `
        <div style=" background-color:rgba(0,0,0,0.5);" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div style="width:120%; height:100%; z-index: ; border-raduis:5px;" class="modal-content">
                    <div style="background-color: #D9FFFF; color: ; height: 65px;" class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Modifier</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action=""  class="needs-validation" novalidate>
                        <div style="background-color: #DEDEDE" class="modal-body">
                            <div style="margin-top:0px;" class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="codee" class="form-label">Apogee :</label>
                                    <input value="${identifiant}" style="margin-bottom: 20px;" name="code" id="codee" type="text" class="form-control" placeholder="Apogee" required readonly>
                                </div>
                                <div class="col">
                                    <label style="margin-left: 0px;" for="cine" class="form-label">CIN :</label>
                                    <input value="${cin}" style="margin-bottom: 20px;" id="cine" name="CIN" type="text" class="form-control" placeholder="CIN" aria-label="First name" required>
                                </div>
                                <div class="col">
                                    <label style="margin-left: 0px;" for="cnee" class="form-label">CNE :</label>
                                    <input value="${cne}" style="margin-bottom: 20px;" id="cnee" name="CNE" type="text" class="form-control" placeholder="CNE" aria-label="First name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="nomae" class="form-label">Nom Arab :</label>
                                    <input value="${noma}" style="margin-bottom: 20px;" id="nomae" name="noma" type="text" class="form-control" placeholder="Nom Arab" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label style="margin-left: 0px;" for="prenomae" class="form-label">Prénom Arab :</label>
                                    <input value="${prenoma}" style="margin-bottom: 20px;" id="prenomae" name="prenoma" type="text" class="form-control" placeholder="Prénom Arab" aria-label="Last name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="nf" class="form-label">Nom Français :</label>
                                    <input value="${nomf}" style="margin-bottom: 20px;" name="nomf" type="text" class="form-control" id="nf" placeholder="Nom Français" required>
                                </div>
                                <div class="col">
                                    <label style="margin-left: 0px;" for="pf" class="form-label">Prénom Français :</label>
                                    <input value="${prenomf}" style="margin-bottom: 20px;" name="prenomf" type="text" class="form-control" id="pf"  placeholder="Prénom Français" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="datenaissance" class="form-label">Date Naissance :</label>
                                    <input value="${datenaissance}" style="margin-bottom: 20px;" name="datenaiss" type="date" class="form-control" id="datenaissance" placeholder="Date Naissance">
                                </div>
                                <div class="col">
                                    <label style="margin-left: 0px;" for="lieufr" class="form-label">lieux Français :</label>
                                    <input value="${liueF}" style="margin-bottom: 20px;"name="liueF" type="text" class="form-control" id="lieufr"  placeholder="lieux Français">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="liueA" class="form-label">Lieux Arab :</label>
                                    <input value="${liueA}" style="margin-bottom: 20px;" name="liueA" type="text" class="form-control" id="liueA" placeholder="Lieux Arab">
                                </div>
                                <div class="col">
                                    <label style="margin-left: 0px;" for="formationf" class="form-label">Formation :</label>
                                    <input value="${formation}" style="margin-bottom: 20px;" name="formation" type="text" class="form-control" id="formationf"  placeholder="Formation">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="margin-left: 0px;" for="etablissement" class="form-label">Etablissement :</label>
                                    <input value="${etablissement}" style="margin-bottom: 0px;" name="etabliss" type="text" class="form-control" id="etablissement" placeholder="Etablissement">
                                </div>
                                <div class="col">
                                    <label style="margin-left: 0px;" for="specialitee" class="form-label">Specialite :</label>
                                    <input value="${specialite}" style="margin-bottom: 20px;" name="specialite" type="text" class="form-control" id="specialitee"  placeholder="Specialite">
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
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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