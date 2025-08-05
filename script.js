const signUpButton=document.getElementById("signUpButton");
const signInButton=document.getElementById("signInButton");
const signInForm=document.getElementById("signInForm");
const signUpForm=document.getElementById("signUpForm");

signUpButton.addEventListener('click',function(){
    signInForm.style.display="none";
    signUpForm.style.display="block";
})
signInButton.addEventListener('click',function(){
    signInForm.style.display="block";
    signUpForm.style.display="none";

})

        // Display error messages from URL parameters
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            const errorMessage = document.getElementById('login-error-message');
            
            if (error) {
                if (error === 'invalid_password') {
                    errorMessage.textContent = 'Invalid password!';
                } else if (error === 'user_not_found') {
                    errorMessage.textContent = 'No user found with that email!';
                } else {
                    errorMessage.textContent = 'An error occurred. Please try again.';
                }
                errorMessage.style.display = 'block';
            }
        });