import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:emergo_mobile/screens/auth/login_screen.dart';
import 'package:emergo_mobile/screens/petugas/petugas_state_screen.dart';
import 'package:emergo_mobile/widgets/report_category_widget/report_category_widget.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:flutter/material.dart';

class ResponseScreen extends StatefulWidget {
  const ResponseScreen({super.key});

  @override
  State<ResponseScreen> createState() => _ResponseScreenState();
}

class _ResponseScreenState extends State<ResponseScreen>
    with SingleTickerProviderStateMixin {
  bool showWidgets = false;
  bool _isInitialized = false;
  late AnimationController _controller;
  late Animation<double> _fadeAnimation;
  late Animation<double> _scaleAnimation;

  void _onLongPress() async {
    await Future.delayed(const Duration(seconds: 2));
    setState(() {
      showWidgets = true;
    });
    _controller.forward();
  }

  Stream<List<String>> getUniqueReportTypes() {
    return FirebaseFirestore.instance.collection('reports').snapshots().map((
        snapshot,
        ) {
      final allTypes = snapshot.docs
          .map((doc) => doc['type'] as String)
          .toList();
      return allTypes.toSet().toList();
    });
  }

  IconData getIcon(String type) {
    switch (type.toLowerCase()) {
      case 'kebakaran':
        return Icons.local_fire_department;
      case 'kecelakaan':
        return Icons.car_crash;
      case 'bencana':
        return Icons.warning;
      case 'kejahatan':
        return Icons.security;
      default:
        return Icons.help_outline;
    }
  }

  Color getColor(String type) {
    switch (type.toLowerCase()) {
      case 'kebakaran':
        return Colors.red;
      case 'kecelakaan':
        return Colors.blue;
      case 'bencana':
        return Colors.deepPurple;
      case 'kejahatan':
        return Colors.black;
      default:
        return Colors.teal;
    }
  }

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 800),
    );

    _fadeAnimation = Tween<double>(
      begin: 0,
      end: 1,
    ).animate(CurvedAnimation(parent: _controller, curve: Curves.easeIn));

    _scaleAnimation = Tween<double>(
      begin: 0.0,
      end: 1.0,
    ).animate(CurvedAnimation(parent: _controller, curve: Curves.elasticOut));

    WidgetsBinding.instance.addPostFrameCallback((_) {
      setState(() {
        _isInitialized = true;
      });
    });
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  Widget _buildAnimatedWidget(Widget child) {
    if (!_isInitialized ||
        (!_controller.isCompleted && !_controller.isAnimating)) {
      return const SizedBox.shrink();
    }

    return FadeTransition(
      opacity: _fadeAnimation,
      child: ScaleTransition(scale: _scaleAnimation, child: child),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        actions: [
          IconButton(
            icon: const Icon(Icons.logout, color: Colors.black),
            onPressed: () async {
              await FirebaseAuth.instance.signOut();
              Navigator.pushAndRemoveUntil(
                context,
                MaterialPageRoute(builder: (_) => LoginScreen()),
                    (route) => false,
              );
            },
          )
        ],
      ),
      backgroundColor: Colors.white,
      body: SafeArea(
        child: Stack(
          alignment: Alignment.center,
          children: [
            Positioned(
              top: 50,
              child: Image.asset('assets/logo.jpeg', height: 170),
            ),
            if (showWidgets)
              Positioned(
                top: 300,
                child: SizedBox(
                  width: MediaQuery.of(context).size.width,
                  height: 350,
                  child: StreamBuilder<List<String>>(
                    stream: getUniqueReportTypes(),
                    builder: (context, snapshot) {
                      if (!snapshot.hasData) {
                        return const Center(child: CircularProgressIndicator());
                      }

                      final types = snapshot.data!;

                      return GridView.count(
                        crossAxisCount: 2,
                        crossAxisSpacing: 50,
                        mainAxisSpacing: 50,
                        children: types.map((type) {
                          return _buildAnimatedWidget(
                            ReportCategoryWidget(
                              title: type,
                              icon: getIcon(type),
                              color: getColor(type),
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => PetugasStateScreen(
                                      reportType: type,
                                      icon: getIcon(type),
                                      iconColor: getColor(type),
                                    ),
                                  ),
                                );
                              },
                            ),
                          );
                        }).toList(),
                      );
                    },
                  ),
                ),
              ),
            Positioned(
              top: 300,
              child: AnimatedOpacity(
                opacity: showWidgets ? 0.6 : 1.0,
                duration: const Duration(milliseconds: 300),
                child: IgnorePointer(
                  ignoring: showWidgets,
                  child: GestureDetector(
                    onLongPress: _onLongPress,
                    child: Container(
                      padding: const EdgeInsets.all(50),
                      decoration: BoxDecoration(
                        color: const Color(0xFFE53935),
                        shape: BoxShape.circle,
                        border: Border.all(
                          color: const Color(0xFFFFB74D),
                          width: 15,
                        ),
                      ),
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: const [
                          Icon(Icons.sensors, color: Colors.white, size: 60),
                          SizedBox(height: 10),
                          Text(
                            'HOLD TO\n RESPONSE',
                            textAlign: TextAlign.center,
                            style: TextStyle(
                              color: Colors.white,
                              fontWeight: FontWeight.bold,
                              letterSpacing: 1,
                              fontSize: 18.88,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
