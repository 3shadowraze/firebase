importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyBo8mV4LejIJrDHIpBEO7jIlJjsNe6IX4E",
    projectId: "taban-f4cf2.firebaseapp.com",
    messagingSenderId: "570241229650",
    appId: "1:570241229650:web:6d29be103ba9b3a559108b"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});