document.getElementById('edit-profile').addEventListener('click', function() {
    const form = document.getElementById('profile-form');
    if (form.classList.contains('hidden')) {
      form.classList.remove('hidden');
    } else {
      form.classList.add('hidden');
    }
  });
  
  document.getElementById('profile-form').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Profile updated successfully!');
  });
  