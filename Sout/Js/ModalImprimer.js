var ModalWrap1 = null;
//don't creat multiple modal
if(ModalWrap1 !== null){
  modal.remove();
}

const ModalImprimer = function(id) {
    ModalWrap1 = document.createElement('div');
    ModalWrap1.innerHTML = `
        <div style=" background-color:rgba(0,0,0,0.5);" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div style="width:100%; height:100%; z-index:1 ; border-raduis:5px;" class="modal-content Mdimpr">
                    <div style="background-color: #D9FFFF; color: ; height: 65px;" class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Imprimer</h3>
                        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body"  style="Text-align:center;">
                        <a class="btn btn-secondary" style="width: 400px;margin-bottom:10px;" target="_blanck" href="Convert html to pdf/ATTESTATION DE REUSSIT.php?id=`+id+`" >ATTESTATION DE REUSSIT DOCTEUR</a>
                        <a class="btn btn-secondary" style="width: 400px;margin-bottom:10px;">ATTESTATION DE JURY</a>
                        <a class="btn btn-secondary" style="width: 400px;">DIPLOME DE DOCTORAT</a>
                    </div>
                    <div style="background-color: #D9FFFF;padding-bottom: 6px; padding-right: 15px; padding-top: 10px; height: 65px;" class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.append(ModalWrap1);
    var modal = new bootstrap.Modal(ModalWrap1.querySelector('.modal'));
    modal.show();
}