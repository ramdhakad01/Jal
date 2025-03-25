document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    const toggleButtons = document.querySelectorAll('.btn-toggle');
    let formData = {
        serviceType: 'residential',
        plan: 'basic'
    };

    // Handle toggle buttons
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const value = this.dataset.value;
            const parent = this.parentElement;
            
            // Remove active class from siblings
            parent.querySelectorAll('.btn-toggle').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Add active class to clicked button
            this.classList.add('active');

            // Update formData based on button group
            if (parent.classList.contains('three-cols')) {
                formData.plan = value;
            } else {
                formData.serviceType = value;
            }
        });
    });

    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formElements = form.elements;
        formData = {
            ...formData,
            name: formElements.name.value,
            email: formElements.email.value,
            phone: formElements.phone.value,
            address: formElements.address.value
        };

        // Log form data (replace with your API call)
        console.log('Form submitted:', formData);
        
        // Optional: Show success message
        alert('Registration submitted successfully!');
        
        // Optional: Reset form
        form.reset();
        
        // Reset toggle buttons to default state
        toggleButtons.forEach(button => {
            if (button.dataset.value === 'residential' || button.dataset.value === 'basic') {
                button.classList.add('active');
            } else {
                button.classList.remove('active');
            }
        });
    });
});

//otp statement

function sendotptoggle(){
    document.getElementById("otp").style.display="block";
    document.getElementById("verify").style.display="block";
    document.getElementById("sendotp").style.display="none";
}
function sendotptoggle_number(){
    document.getElementById("otp_number").style.display="block";
    document.getElementById("verify_number").style.display="block";
    document.getElementById("sendotp_number").style.display="none";
}

    // function send_otp() {
    //     let email = document.getElementById("email").value;

    //     if (email === "") {
    //         alert("Please enter an email first");
    //         return;
    //     }

    //     let xhr = new XMLHttpRequest();
    //     xhr.open("POST", "send_otp.php", true);
    //     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    //     xhr.onreadystatechange = function () {
    //         if (xhr.readyState === 4 && xhr.status === 200) {
    //             document.getElementById("otpResponse").innerText = xhr.responseText;
    //         }
    //     };

    //     xhr.send("email=" + email);
    // }

