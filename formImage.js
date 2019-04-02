function readURL() {
    let reader = new FileReader();

    reader.onload = function (e) {
        document.getElementById('imgPreview').src = e.target.result;

        localStorage.setItem("formImage", e.target.result);
    }

    reader.readAsDataURL(document.getElementById('file').files[0]);

    document.getElementById('imgPreview').hidden = false;

}

function preview() {
    if (localStorage.getItem("formImage")) {
        localStorage.removeItem("formImage");
    }
    if (localStorage.getItem("dimLarg")) {
        localStorage.removeItem("dimLarg")
    }
    if (localStorage.getItem("dimAlt")) {
        localStorage.removeItem("dimAlt")
    }
    if (localStorage.getItem("nomImg")) {
        localStorage.removeItem("nomImg")
    }
    document.getElementById('dimLarg').value = "";
    document.getElementById('dimAlt').value = "";
    document.getElementById('nomImg').value = "";
    readURL();
}

function dimensLarg() {
    if (localStorage.getItem("dimLarg")) {
        localStorage.removeItem("dimLarg")
    }

    let dimLarg = document.getElementById('dimLarg').value;

    localStorage.setItem("dimLarg", dimLarg);

}
function dimensAlt() {
    if (localStorage.getItem("dimAlt")) {
        localStorage.removeItem("dimAlt")
    }

    let dimAlt = document.getElementById('dimAlt').value;

    localStorage.setItem("dimAlt", dimAlt);

}
function imgOnBlur() {
    if (localStorage.getItem("nomImg")) {
        localStorage.removeItem("nomImg")
    }

    let nomeImagem = document.getElementById('nomImg').value;

    localStorage.setItem("nomImg", nomeImagem);

}