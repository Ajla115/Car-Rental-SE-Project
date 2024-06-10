$(document).ready(function() {
    $('#addCarForm').on('submit', function(event) {
        event.preventDefault();
        addCar();
    });
});

function addCar() {
    const carName = $('#carName').val();
    const carModel = $('#carModel').val();
    const carYear = $('#carYear').val();

    $.ajax({
        url: "../rest/cars",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({ name: carName, model: carModel, year: carYear }),
        beforeSend: function(xhr) {
            xhr.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getItem("jwt") // Assuming JWT is stored in localStorage
            );
        },
        success: function(response) {
            alert(response.message);
            $('#addCarForm')[0].reset();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error adding car:', textStatus, errorThrown);
        }
    });
}
