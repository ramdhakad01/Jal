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