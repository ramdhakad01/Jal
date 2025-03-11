 // JavaScript to toggle between Sign In and Sign Up forms
 const signUpButton = document.getElementById("signUp");
 const signInButton = document.getElementById("signIn");
 const container = document.getElementById("container");

 signUpButton.addEventListener("click", () => {
     container.classList.add("right-panel-active");
 });

 signInButton.addEventListener("click", () => {
     container.classList.remove("right-panel-active");
 });
 
// Form validation
const forms = document.querySelectorAll('form');

forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const email = form.querySelector('input[type="email"]').value;
        const password = form.querySelector('input[type="password"]').value;
        
        if (!email || !password) {
            alert('Please fill in all fields');
            return;
        }
        
        if (!isValidEmail(email)) {
            alert('Please enter a valid email address');
            return;
        }
        
        if (password.length < 6) {
            alert('Password must be at least 6 characters long');
            return;
        }
        
        // Here you would typically send the form data to your server
        console.log('Form submitted:', { email, password });
    });
});

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}