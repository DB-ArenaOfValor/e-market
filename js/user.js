// the form selected
var selectedTab = "product";
console.log(decodeURIComponent(document.cookie));
var userName = getParameterByName("userName");
var userID = getParameterByName("userID");
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
    formData.append("userID", userID);
    displayFormData(formData);
    ajax("POST", "find_" + tab + ".php", formData, fill);
    // }
    //////////////////////////////// for test
    //    fill(
    //        JSON.parse(
    //            '[{"PID": "00000001","state":"0","brand": "Blueberry","model": "iPhone X","year": "2017-11-03","color": "navy red","use_time": "0.2","price": "832.14","image": "1"},{"PID": "00000002","brand": "Sony","model": "iPhone X","year": "2017-11-03","color": "black","use_time": "0.2","price": "832.14","image": "1"}]'
    //        )
    //    );
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
    var sellerID = formData.get("sellerID");
    var usercartid = formData.get("user_cartID");
    if (sellerID != userID && usercartid != userID) {
        alert("You do not have the authority to do this...");
    }
    else if(usercartid == userID){
        ajax(
            "POST",
            "delete_cart.php",
            formData,
            () => e.target.parentNode.remove() // remove clicked row
        );
        alert("Delete successfully!");
    }
    else {
        ajax(
            "POST",
            "delete_" + selectedTab + ".php",
            formData,
            () => e.target.parentNode.remove() // remove clicked row
        );
        alert("Delete successfully!");
    }
}

// update an item
function updataItem(e) {
    var formData = getRow(e.target);
    formData.append("userName", userName);
    displayFormData(formData);
    var sellerID = formData.get("sellerID");
    var userid = formData.get("userID");
    if (sellerID != userID && userid != userID) {
        alert("You do not have the authority to do this...");
        load("product");
    } else if (userid == userID) {
        ajax("POST", "update_user.php", formData, () =>
            alert("Update sccessfully!")
        );
    } else {
        ajax("POST", "update_" + selectedTab + ".php", formData, () =>
            alert("Update sccessfully!")
        );
    }
}

// add an Item
function addItem(e) {
    var formData = getRow(e.target);
    formData.append("userName", userName);
    displayFormData(formData);
    ajax("POST", "add_" + selectedTab + ".php", formData, addCallback);
    clearAddRow();
}
