/*he showForm function is used to manage a group of "form boxes" (elements with the class form-box), making one of them active (visible/styled) while ensuring all others are inactive (hidden/unstyled). This is commonly used in UIs with multiple forms or sections where only one should be displayed at a time, like tabbed interfaces or multi-step forms.*/
function showForm(formId) {
    document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");
}