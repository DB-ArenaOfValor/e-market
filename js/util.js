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
    xmlhttp.open(method, "../php/" + url, true);
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

// add table row for each item in the result
function fillTable(array) {
    // add table header
    var thead = document.querySelector("thead");
    thead.innerHTML = "";

    var item = array[0];
    var keys = [];
    for (var key in item) {
        keys.push(key);

        var div = document.createElement("div");
        div.innerHTML = key;
        var th = document.createElement("th");
        th.innerHTML = key + div.outerHTML;
        thead.appendChild(th);
    }

    //add table content
    var tbody = document.querySelector("tbody");
    tbody.innerHTML = ""; // clear table

    // new row to add item
    var newRow = document.createElement("tr");
    for (var index in keys)
        newRow.innerHTML += "<td contenteditable='true'></td>"; // blank cell
    newRow.innerHTML += "<td class='add' onclick='addItem(event)'>Add</td>"; // add cell
    tbody.appendChild(newRow);

    for (var i = 0; array && i < array.length; i++) {
        var a = array[i];
        var row = document.createElement("tr");
        for (var j in keys) {
            var k = keys[j];
            row.innerHTML +=
                "<td onkeydown='' onblur='updataItem(event)' contenteditable='true'>" +
                a[k] +
                "</td>";
        }
        row.innerHTML += "<td onclick='deleteItem(event)'>&#9003;</td>"; // delete cell
        tbody.appendChild(row);
    }
    return keys;
}

// add filter for each attribute
function fillFilter(keys) {
    var filter = document.querySelector(".filter");
    filter.innerHTML = "";

    for (var i in keys) {
        filter.innerHTML +=
            "<div class='catagory'><div class='title'>" +
            keys[i] +
            "</div><input  name='" +
            keys[i] +
            "' type='text'></div>";
    }
}

// failure: alert
// success: alert, clear add row and add a row in the current table
function addCallback(result) {
    //failure
    if (!result.success) {
        alert("Error!");
        return;
    }

    //success
    alert("Item added successfully!");
    //clear the add row
    clearAddRow();
    // add a new row in the current table
    var row = document.createElement("tr");
    for (var key in result.data) {
        row.innerHTML +=
            "<td onblur='updataItem(event)' contenteditable='true'>" +
            result.data[key] +
            "</td>";
    }
    row.innerHTML += "<td onclick='deleteItem(event)'>&#9003;</td>"; // delete cell
    document.querySelector("tbody").appendChild(row);
}

// clear the add row after successfully adding an item
function clearAddRow() {
    var tds = document.querySelector("td.add").parentNode.childNodes;
    for (var i = 0; i < tds.length - 1; i++) {
        tds[i].innerHTML = "";
    }
}
