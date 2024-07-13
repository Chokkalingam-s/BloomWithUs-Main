function showCustomAlert(message) {
    const alertMessageElement = document.getElementById('customAlertMessage');
    alertMessageElement.innerText = message;

    const customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
    customAlertModal.show();
}
document.addEventListener('DOMContentLoaded', function() {
const customAlertModal = document.getElementById('customAlertModal');

customAlertModal.addEventListener('hidden.bs.modal', function() {
    location.reload();
});
});