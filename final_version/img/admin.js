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
    // fill(
    //     JSON.parse(
    //         '[{"PID": "00000001","state":"0","brand": "Blueberry","model": "iPhone X","year": "2017-11-03","color": "navy red","use_time": "0.2","price": "832.14","image": "1"},{"PID": "00000002","brand": "Sony","model": "iPhone X","year": "2017-11-03","color": "black","use_time": "0.2","price": "832.14","image": "1"}]'
    //     )
    // );
}

// fill table and filter
function fill(array) {
    var keys = fillTable(array);
    fillFilter(keys);
}

// submit filter when form is changed and change table
function submitFilter() {
    var formData = new FormData(document.querySelector("form.filter"));
    displayFormData(formData);
    ajax("POST", "find_" + selectedTab + ".php", formData, fillTable);
}

// delete an item
function deleteItem(e) {
    ajax(
        "POST",
        "delete_" + selectedTab + ".php",
        getRow(e.target),
        () => e.target.parentNode.remove() // remove clicked row
    );
}

// update an item
function updataItem(e) {
    ajax("POST", "update_" + selectedTab + ".php", getRow(e.target));
}

function addItem(e) {
    var formData = getRow(e.target);
    ajax("POST", "add_" + selectedTab + ".php", formData, addCallback);
    clearAddRow();
}
