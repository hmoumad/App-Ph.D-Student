var ModalWrap = null;

//don't creat multiple modal
if(ModalWrap !== null){
  modal.remove();
}

const SupprimerSout = (title, description, value, btnyes, btnNO) => {
    ModalWrap = document.createElement('div');
    ModalWrap.innerHTML = `
        <div style=" background-color:rgba(0,0,0,0.5); position: absolute;" class="modal fade" tabindex="-1">
            <div style="width:50%; height:30%; z-index: -1; border-raduis:3px;" class="modal-dialog bg-light">
                <div class="modal-content">
                    <div style="height:50px" class="modal-header bg-light">
                        <h3 class="modal-title">${title}</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div style="margin-top: 25px; height:100px" class="modal-body text-center">
                        <p style="font-weight: bold;">${description} ${value}</p>
                    </div>
                    <div style="height:50px;" class="modal-footer bg-light">
                        <button style="margin-top: -5px;" type="button" class="btn btn-success" data-bs-dismiss="modal">${btnNO}</button>
                        <a style="margin-top: -5px; margin-left: 15px;" name="Delete" href="PHP/SupprimerSoutnance.php?idS=${value}" class="btn btn-danger">${btnyes}</a>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.append(ModalWrap);
    var modal = new bootstrap.Modal(ModalWrap.querySelector('.modal'));
    modal.show();
}