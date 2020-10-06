function checkCheckboxes() {
    var checkboxes = document.getElementsByName("checked[]");
    var disableButtons = true;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            disableButtons = false;
        }
    }

    document.getElementById('submit').disabled = disableButtons;
    document.getElementById('reset').disabled = disableButtons;
}

function confirmation() {
    var checkboxes = document.getElementsByName("checked[]");
    var checked = 0;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) checked += 1;
    }

    var message = "these " + checked + " products";
    if (checked == 1) message = "this product";

    return confirm("Are you sure you want to delete " + message + "? This action cannot be undone.");
}

function validateForm() {
    document.getElementById('submit').disabled = disableButtons;
    document.getElementById('reset').disabled = disableButtons;

    var checkboxes = document.getElementsByName("checked[]");

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            return true;
        }
    }

    return false;
}

function disable() {
    document.getElementById('submit').disabled = true;
}