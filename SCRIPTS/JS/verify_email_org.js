
function checkOrganizationEmail() {
    const emailInput = document.getElementById('email');
    const orgInput = document.querySelector('input[name="org"]');
    const email = emailInput.value;
    const organizationDomains = ["gmail.com", "outlook.com", "hotmail.com", "yahoo.com"];
    const emailDomain = email.split('@')[1];

    if (organizationDomains.includes(emailDomain)) {
        orgInput.value = false;
    } else {
        orgInput.value = true;
    }
}

window.onload = function () {
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', checkOrganizationEmail);
};
