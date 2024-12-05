function switchTab(userType) {
    // Toggle tab styles
    document.getElementById('nim-tab').className = userType === 'nim' ? 'NIM-button-active' : 'NIM-button';
    document.getElementById('nip-tab').className = userType === 'nip' ? 'NIP-button-active' : 'NIP-button';

    // Change the user_type hidden field value
    document.getElementById('user-type').value = userType;

    // Update the label and placeholder for the username input
    const usernameLabel = userType === 'nim' ? 'NIM' : 'NIP';
    const usernamePlaceholder = userType === 'nim' ? 'Masukkan NIM' : 'Masukkan NIP';
    document.querySelector('label[for="username"]').innerText = usernameLabel;
    document.getElementById('username').placeholder = usernamePlaceholder;
}

function redirectToPage(page) {
    window.location.href = page; // Navigasi ke halaman target
}