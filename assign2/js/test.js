// File name: test.js
// Author: Yanni Ye, Yi Yao, Peiwen Liu
// Description: This JavaScript file contains functions for displaying and managing modal windows for add, filter, modify, and delete products

// Get modal elements and assign them to variables
const addModal = document.getElementById('addModal');
const filterModal = document.getElementById('filterModal');
const modifyModal = document.getElementById('modifyModal');
const deleteModal = document.getElementById('deleteModal');

// Function to display add modal
function displayAddModal() {
    addModal.style.display = 'block';
}
// Function to close add modal
function closeAddModal() {
    addModal.style.display = 'none';
}

// Function to display filter modal
function displayFilterModal() {
    filterModal.style.display = 'block';
}
// Function to close filter modal
function closeFilterModal() {
    filterModal.style.display = 'none';
}

// Function to close modify modal
function closeModifyModal() {
    window.location.href = '../index.php';
}

// Function to open delete modal
function displayDeleteModal() {
    deleteModal.style.display = 'block';
}
// Function to close delete modal
function closeDeleteModal() {
    deleteModal.style.display = 'none';
    window.location.href = '../index.php';
}
// Function to cancel delete option
function cancelDeleteChanges() {
    closeDeleteModal();
}

// Function to cancel add option
function cancelAddChanges() {
    clearForm();
    closeAddModal();
}
// Function to clear add form data
function clearForm() {
    document.getElementById('addProductId').value = "";
    document.getElementById('addProductName').value = "";
    document.getElementById('addProductQuantity').value = "";
    document.getElementById('addProductAmount').value = "";
    document.getElementById('addStockStatus').value = "inStock";
    document.getElementById('stockInTime').value = "";
    document.getElementById('stockOutTime').value = "";
}

// Function to cancel filter changes
function cancelFilterChanges() {
    clearFilterForm();
    closeFilterModal();
    document.getElementById('filterForm').submit();
}
// Function to clear filter form data
function clearFilterForm() {
    document.getElementById('filterProductId').value = "";
    document.getElementById('filterProductName').value = "";
    document.getElementById('filterMinQuantity').value = "";
    document.getElementById('filterMaxQuantity').value = "";
    document.getElementById('filterMinPrice').value = "";
    document.getElementById('filterMaxPrice').value = "";
    document.getElementById('filterStockStatus').value = "all";
    document.getElementById('filterStockTimeStart').value = "";
    document.getElementById('filterStockTimeEnd').value = "";
}

// Function to cancel modify changes
function cancelModifyChanges() {
    // Clear form data
    clearModifyForm();
    // Close modify modal
    closeModifyModal();
}

// Function to clear modify form data
function clearModifyForm() {
    document.getElementById('modifyProductId').value = "";
    document.getElementById('modifyProductName').value = "";
    document.getElementById('modifyProductQuantity').value = "";
    document.getElementById('modifyProductAmount').value = "";
    document.getElementById('modifyStockStatus').value = "inStock";
    document.getElementById('modifyStockInTime').value = "";
    document.getElementById('modifyStockOutTime').value = "";
}



