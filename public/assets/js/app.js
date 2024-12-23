// Reusable function with customization options
function showNotification(title = "Success", message, icon = "success") {
    Swal.fire({
        title: title,
        text: message,
        icon: icon
    });
}
