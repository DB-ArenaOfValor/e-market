function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return "";
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function ajax(method, url, data, callback) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(JSON.parse(this.responseText));
            callback && callback(JSON.parse(this.responseText));
            return this.responseText;
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send(data);
}

function resetForm() {
    var form = document.querySelector("form");
    form.reset();
}

function toggleSelected(tab) {
    document.querySelector("." + selectedTab).classList.toggle("selected");
    document.querySelector("." + tab).classList.toggle("selected");
    selectedTab = tab;
}

function displayFormData(formData) {
    // Display the key/value pairs
    for (var pair of formData.entries()) {
        console.log(pair[0] + ", " + pair[1]);
    }
}

// get the key/value pair in the row containing the cell
// and return as formdata
function getRow(cell) {
    // get keys from table head
    var ths = Array.from(document.querySelectorAll("th div"));
    var keys = ths.map(v => v.innerHTML);

    // get values from the row
    var tds = Array.from(cell.parentNode.childNodes).slice(
        0,
        this.length - 1 // remove the last "delete cell"
    );
    var values = tds.map(v => v.innerHTML);

    // construct formData
    var formData = new FormData();
    keys.map((v, i) => {
        formData.append(v, values[i]);
    });
    displayFormData(formData);
    return formData;
}
