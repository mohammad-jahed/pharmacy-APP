// Scripts for firebase and firebase messaging
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing the generated config
var firebaseConfig = {
    apiKey: "AIzaSyCJW35oQJgJo2NFhBvo6IJqXbSqHDX7G6M",
    authDomain: "car4sure-8407d.firebaseapp.com",
    projectId: "car4sure-8407d",
    storageBucket: "car4sure-8407d.appspot.com",
    messagingSenderId: "954455217532",
    appId: "1:954455217532:web:2389310804c00fddffc0f9"
};

firebase.initializeApp(firebaseConfig);

// Retrieve firebase messaging
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('Received background message ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
    };

    self.registration.showNotification(notificationTitle,
        notificationOptions);
});
