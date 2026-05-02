import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore";

const firebaseConfig = {
  apiKey: "xxx",
  authDomain: "xxx.firebaseapp.com",
  projectId: "xxx",
  storageBucket: "xxx.firebasestorage.app",
  messagingSenderId: "xxx",
  appId: "xxx"
};

const app = initializeApp(firebaseConfig);
export const db = getFirestore(app);
import { collection, addDoc, serverTimestamp } from "firebase/firestore";
import { db } from "./firebase";

await addDoc(collection(db, "mesures"), {
  nom: "point A",
  valeur: 12.5,
  date: serverTimestamp()
});
import { collection, getDocs } from "firebase/firestore";
import { db } from "./firebase";

const snapshot = await getDocs(collection(db, "mesures"));

snapshot.forEach((doc) => {
  console.log(doc.id, doc.data());
});
rules_version = '2';

service cloud.firestore {
  match /databases/{database}/documents {
    match /{document=**} {
      allow read, write: if true;
    }
  }
}
