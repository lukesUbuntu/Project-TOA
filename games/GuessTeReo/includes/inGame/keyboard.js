function input(e) {
    var tbInput = document.getElementById("tbInput");
    tbInput.value = tbInput.value + e.value;
}

function del() {
    var tbInput = document.getElementById("tbInput");
    tbInput.value = tbInput.value.substr(0, tbInput.value.length - 1);
}