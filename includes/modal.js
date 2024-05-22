// JavaScript for handling modals
const deleteModal = document.getElementById('deleteModal');
const closeModalElements = document.getElementsByClassName('close');

Array.from(closeModalElements).forEach(element => {
    element.onclick = function() {
        deleteModal.style.display = 'none';
    }
});

document.getElementById('cancelDeleteBtn').onclick =function(event){
    deleteModal.style.display = 'none';
}
let postIdToDelete = null;

document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        postIdToDelete = e.target.getAttribute('data-id');
        deleteModal.style.display = 'block';
    });
});

document.getElementById('confirmDeleteBtn').onclick = function() {
    if (postIdToDelete) {
        window.location.href = 'delete.php?id=' + postIdToDelete;
    }
}

window.onclick = function(event) {
    if (event.target == deleteModal) {
        deleteModal.style.display = 'none';
    }
}