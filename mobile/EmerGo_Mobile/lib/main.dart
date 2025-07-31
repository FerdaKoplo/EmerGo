import 'package:emergo_mobile/app.dart';
import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/material.dart';

const String role = String.fromEnvironment('ROLE', defaultValue: 'pelapor');

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await Firebase.initializeApp();

  runApp(const ReportSceneApp());;
}
