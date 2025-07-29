import 'package:flutter/material.dart';
import 'package:emergo_mobile/screens/report_screen.dart';

class ReportSceneApp extends StatelessWidget {
  const ReportSceneApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Emergo',
      home: ReportScreen(),
    );
  }
}