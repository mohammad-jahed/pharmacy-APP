// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging, getToken } from "firebase/messaging";
import { getAnalytics } from "firebase/analytics";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyCJW35oQJgJo2NFhBvo6IJqXbSqHDX7G6M",
    authDomain: "car4sure-8407d.firebaseapp.com",
    projectId: "car4sure-8407d",
    storageBucket: "car4sure-8407d.appspot.com",
    messagingSenderId: "954455217532",
    appId: "1:954455217532:web:2389310804c00fddffc0f9",
    measurementId: "G-4SEJ82BY65"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

const messaging = getMessaging();
getToken(messaging, { vapidKey: 'BPPwdXgovlz7lFwE1RlMsU8qJPqZaJGrEJkWuuNTvafiqFcaXzbxeYTmVl-3sTAuKls6cFdM7wpxpf4-4iuQoDo' }).then((currentToken) => {
    if (currentToken) {
        // Send the token to your server and update the UI if necessary
        // ...

        console.log('fcm token',currentToken);
    } else {
        // Show permission request UI
        console.log('No registration token available. Request permission to generate one.');
        // ...
    }
}).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
});
