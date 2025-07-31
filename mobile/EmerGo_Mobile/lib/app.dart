import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:emergo_mobile/screens/auth/login_screen.dart';
import 'package:emergo_mobile/screens/pelapor/report_screen.dart';
import 'package:emergo_mobile/screens/petugas/response_screen.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:flutter/material.dart';

class ReportSceneApp extends StatelessWidget {
  const ReportSceneApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Emergo',
      home: const RootPage(),
      routes: {
        '/report': (context) => const ReportScreen(),
        '/response': (context) => const ResponseScreen(),
      },
    );
  }
}

class RootPage extends StatelessWidget {
  const RootPage({super.key});

  @override
  Widget build(BuildContext context) {
    return StreamBuilder<User?>(
      stream: FirebaseAuth.instance.authStateChanges(),
      builder: (context, snapshot) {
        // User belum login
        if (!snapshot.hasData) {
          return  LoginScreen();
        }

        final user = snapshot.data!;
        return FutureBuilder<DocumentSnapshot>(
          future: FirebaseFirestore.instance.collection('users').doc(user.uid).get(),
          builder: (context, roleSnapshot) {
            if (roleSnapshot.connectionState == ConnectionState.waiting) {
              return const Scaffold(
                body: Center(child: CircularProgressIndicator()),
              );
            }

            if (!roleSnapshot.hasData || !roleSnapshot.data!.exists) {
              return const Scaffold(
                body: Center(child: Text("User data not found.")),
              );
            }

            final role = roleSnapshot.data!['role'];
            if (role == 'pelapor') {
              return const ReportScreen();
            } else if (role == 'petugas') {
              return const ResponseScreen();
            } else {
              return const Scaffold(
                body: Center(child: Text("Unknown role")),
              );
            }
          },
        );
      },
    );
  }
}
