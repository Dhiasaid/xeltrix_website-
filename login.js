document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');

  form.addEventListener('submit', function (e) {
    const email = form.email.value.trim();
    const password = form.password.value.trim();
    let errors = [];

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email) {
      errors.push("Email is required.");
    } else if (!emailRegex.test(email)) {
      errors.push("Please enter a valid email address.");
    }

    if (!password) {
      errors.push("Password is required.");
    } else if (password.length < 6) {
      errors.push("Password must be at least 6 characters.");
    }

    if (errors.length > 0) {
      e.preventDefault();
      alert(errors.join("\n"));
    }
  });
});
