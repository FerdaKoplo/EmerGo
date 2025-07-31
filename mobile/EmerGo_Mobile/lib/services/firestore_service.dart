import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:firebase_core/firebase_core.dart';

class FirestoreService {
  final FirebaseFirestore _db = FirebaseFirestore.instance;

  final CollectionReference reports = FirebaseFirestore.instance.collection(
      'reports');

  Future<void> submitReport({ required String type }) async {
    await reports.add({
      'type': type,
      'timestamp': Timestamp.now(),
    });
  }

  Stream<QuerySnapshot> getReportsStream() {
    return FirebaseFirestore.instance
        .collection('reports')
        .orderBy('timestamp', descending: true)
        .snapshots();
  }
  // Save user data to Firestore
  Future<void> saveUserData(User user, String role) async {
    await _db.collection('users').doc(user.uid).set({
      'email': user.email,
      'role': role,
      'createdAt': FieldValue.serverTimestamp(),
    });
  }

  // Get user role based on UID
  Future<String?> getUserRole(String uid) async {
    final doc = await _db.collection('users').doc(uid).get();
    return doc.data()?['role'];
  }

}