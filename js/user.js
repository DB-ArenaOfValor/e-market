// the form selected
var selectedTab = "product";
var userName = document.cookie.split(";")[0].split("=")[1];
window.onload = function() {
    load(selectedTab);
};

// load one of the forms
function load(tab) {
    toggleSelected(tab);
    // if(tab == "rating.selectedTab"){
    //     ajax("POST", "find_rating.php", new FormData(), fill);
    // }
    // else{
    var formData = new FormData();
    formData.append("userName", userName);
    ajax("POST", "find_" + tab + ".php", formData, fill);       
    // }
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

// submit filter when form is changed and change table
function submitFilter() {
    var formData = new FormData(document.querySelector("form.filter"));
    formData.append("userName", userName);
    displayFormData(formData);
    ajax("POST", "find_" + selectedTab + ".php", formData, fillTable);
}

// delete an item
function deleteItem(e) {
    var formData = getRow(e.target);
    formData.append("userName", userName);
    displayFormData(formData);
    ajax(
        "POST",
        "delete_" + selectedTab + ".php",
        formData,
        () => e.target.parentNode.remove() // remove clicked row
    );
}

// update an item
function updataItem(e) {
    var formData = getRow(e.target);
    formData.append("userName", userName);
    displayFormData(formData);
    ajax("POST", "update_" + selectedTab + ".php", formData);
}

// add an Item
function addItem(e) {
    var formData = getRow(e.target);
    formData.append("userName", userName);
    displayFormData(formData);
    ajax("POST", "add_" + selectedTab + ".php", formData, addCallback);
    clearAddRow();
}
