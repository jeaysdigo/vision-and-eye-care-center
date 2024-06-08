// Client-side JavaScript code (using Firebase Auth)
firebase.auth().signInWithEmailAndPassword(email, password)
  .then((userCredential) => {
    // Send ID token to PHP backend
    const idToken = userCredential.user.getIdToken();
    // Send idToken to your PHP backend using AJAX or fetch API
  })
  .catch((error) => {
    // Handle sign-in errors
    console.error(error);
  });
