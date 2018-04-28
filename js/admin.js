// the form selected
var selectedTab = "product";

window.onload = function() {
    load(selectedTab);
};

// load one of the forms
function load(tab) {
    toggleSelected(tab);
    ajax("POST", "find_" + tab + ".php", new FormData(), fill);
    //////////////////////////////// for test
    fill(
        JSON.parse(
            '[{"PID": "00000001","state":"0","brand": "Blueberry","model": "iPhone X","year": "2017-11-03","color": "navy red","use_time": "0.2","price": "832.14","image": "1"},{"PID": "00000002","brand": "Sony","model": "iPhone X","year": "2017-11-03","color": "black","use_time": "0.2","price": "832.14","image": "1"}]'
        )
    );
}

// fill table and filter
function fill(array) {
    var keys = fillTable(array);
    fillFilter(keys);
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
    tbody.innerHTML = "";
    for (var i = 0; array && i < array.length; i++) {
        var a = array[i];
        var row = document.createElement("tr");
        for (var j in keys) {
            var k = keys[j];
            row.innerHTML += "<td contenteditable='true'>" + a[k] + "</td>";
        }
        row.innerHTML += "<td onclick='deleteItem(event)''>&#9003;</td>";
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

// submit filter when form is changed and change table
function submitFilter() {
    var formData = new FormData(document.querySelector("form.filter"));
    ajax("POST", "find_" + selectedTab + ".php", formData, fillTable);
}

function deleteItem(e) {
    // get keys
    var ths = Array.from(document.querySelectorAll("th div"));
    var keys = ths.map(v => v.innerHTML);

    // get value
    var tds = Array.from(e.target.parentNode.childNodes).slice(
        0,
        this.length - 1
    );
    var values = tds.map(v => v.innerHTML);

    // construct formData
    var formData = new FormData();
    keys.map((v, i) => {
        formData.append(v, values[i]);
    });
    displayFormData(formData);

    // post php
    ajax("POST", "delete_" + selectedTab + ".php", formData);
}
