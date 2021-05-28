var editTileModal = document.getElementById('editTileModal')
editTileModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var clikedTile = event.relatedTarget
  // Extract info from data-bs-* attributes
  var clikedTileId = clikedTile.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = editTileModal.querySelector('.modal-title')
  var modalBodyInput = editTileModal.querySelector('.modal-body input')

  modalTitle.textContent = 'Edition de la tuile ' + clikedTileId
  modalBodyInput.value = clikedTileId
})