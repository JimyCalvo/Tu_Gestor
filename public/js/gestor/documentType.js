function updateDocumentType(type) {
    var documentNumberInput = document.getElementById('documentNumber');
    var documentTypeButton = document.getElementById('documentTypeButton');

    documentNumberInput.name = type.toLowerCase();
    documentNumberInput.placeholder = 'Número de ' + type;
    documentTypeButton.textContent = type;
}
