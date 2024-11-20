// Function to fetch application count

$(document).ready(function() {
    fetchApplicationCount();
});
function fetchApplicationCount() {
    alert("hello");
    // const BASE_URL = "<?php echo BASE_URL; ?>";
    $.ajax({
        url: BASE_URL + "dashboard/get_pending_application",

        // url: BASE_URL.dashboard-kpi/get_pending_application.php, // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update the widget with the fetched count
            $('#pendingcount').text(response.total);
        },
        error: function() {
            $('#pendingcount').text('Error loading data');
        }
    });
}

// Call the function when the page loads
