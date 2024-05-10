var CarService = {
    /*
    processPayment: function() {
        var self = this; 
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Retrieve form input values
            var name = document.getElementById('name').value;
            var cardNumber = document.getElementById('cardNumber').value;
            var expiryDate = document.getElementById('expiryDate').value;
            var cvv = document.getElementById('cvv').value;
            var zipCode = document.getElementById('zipCode').value;
            var numberOfDays = parseInt(document.getElementById('numberOfDays').value);
            
            //var pricePerDay = document.getElementById('pricevw').value;
            //var totalSum = pricePerDay * numberOfDays;
            var totalSum = parseInt(8 * numberOfDays);

            // Update total sum element
            //document.getElementById('totalSum').textContent = totalSum;
            //document.getElementById('totalSum').textContent = totalSum.toFixed(2);
            document.getElementById('MinivanPaymentTotalSumContainer').textContent = totalSum.toFixed(2);

            // Check if all fields are filled
            if (name === '' || cardNumber === '' || expiryDate === '' || cvv === '' || zipCode === '') {
                // Display toaster message for missing fields
                self.showToast('Please fill in all fields'); // change this line
            } else {
                // All fields filled, redirect to reservation.html
                window.location.href = '#reservation';
            }
        });
    },
    */
    processPayment: function() {
        var self = this;
    
        // Function to calculate and update total sum
        function updateTotalSum() {
            var numberOfDays = parseInt(document.getElementById('numberOfDays').value);
            var totalSum = parseInt(80 * numberOfDays);
            document.getElementById('MinivanPaymentTotalSumContainer').textContent = totalSum.toFixed(2);
        }
    
        // Add event listeners to payment fields
        document.getElementById('numberOfDays').addEventListener('input', updateTotalSum);
        // Add more event listeners for other payment fields if needed
    
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();
    
            // Retrieve form input values
            var name = document.getElementById('name').value;
            var cardNumber = document.getElementById('cardNumber').value;
            var expiryDate = document.getElementById('expiryDate').value;
            var cvv = document.getElementById('cvv').value;
            var zipCode = document.getElementById('zipCode').value;
    
            // Check if all fields are filled
            if (name === '' || cardNumber === '' || expiryDate === '' || cvv === '' || zipCode === '') {
                // Display toaster message for missing fields
                self.showToast('Please fill in all fields'); // change this line
            } else {
                // All fields filled, redirect to reservation.html
                window.location.href = '#reservation';
            }
        });
    
        // Initial update of total sum
        updateTotalSum();
    },
    
    showToast: function(message) {
        // Create toaster element
        var toaster = document.createElement('div');
        toaster.classList.add('toaster');
        toaster.textContent = message;

        // Append toaster to the body
        document.body.appendChild(toaster);

        // Remove toaster after 3 seconds
        setTimeout(function() {
            toaster.remove();
        }, 3000);
    },

    getCarInfo: function(id) {
        $.ajax({
            url: './rest/carinfo/' + id,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
            },
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    var carName = data[i].car_name;
                    var price = data[i].price;
                    var age = data[i].age;
                    var milage = data[i].mileage;
                    var fuel = data[i].fuel;
                    var consumption = data[i].fuel_usage;
                    var gearbox = data[i].gearbox;
                    var passengers = data[i].max_passengers;
    
                    // Create a <div> element to display the car name
                    var carElement = $('<div></div>').text(carName);
                    var priceElement = $('<div></div>').text(price);
                    var ageElement = $('<div></div>').text(age);
                    var milageElement = $('<div></div>').text(milage);
                    var fuelElement = $('<div></div>').text(fuel);
                    var consumptionElement = $('<div></div>').text(consumption);
                    var gearboxElement = $('<div></div>').text(gearbox);
                    var passengersElement = $('<div></div>').text(passengers);
    
                    // Append the carElement to a specific container in your HTML
                    $('#vw7name').append(carElement);
                    $('#pricevw').append(priceElement);
                    $('#agevw').append(ageElement);
                    $('#milagevw').append(milageElement);
                    $('#fueltypevw').append(fuelElement);
                    $('#consumptionvw').append(consumptionElement);
                    $('#gearboxvw').append(gearboxElement);
                    $('#passengersvw').append(passengersElement);
                }
            }
        });
    },

   getReview: function(id) {
        $.ajax({
            url: './rest/tests/' + id,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
            },
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    var testimonial = data[i].comment;
                    //console.log(data[i].comment);
                    var name = data[i].first_name + ' '+ data[i].last_name;
    
                    var testimonialText = $('<div></div>').text(testimonial);
                    console.log(testimonialText);
                    var nameElement = $('<div></div>').text(name);
    
                    $('#testemonialtextvw').append(testimonialText);
                    $('#Clientnamevw').append(nameElement);
                }
            }
        });
    },
};
