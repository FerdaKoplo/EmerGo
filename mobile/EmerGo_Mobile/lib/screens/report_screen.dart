import 'package:emergo_mobile/widgets/report_category_widget/report_category_widget.dart';
import 'package:flutter/material.dart';

class ReportScreen extends StatefulWidget {
  const ReportScreen({super.key});

  @override
  State<ReportScreen> createState() => _ReportScreenState();
}

class _ReportScreenState extends State<ReportScreen> with SingleTickerProviderStateMixin{
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

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 800),
    );

    _fadeAnimation = Tween<double>(begin: 0, end: 1).animate(
      CurvedAnimation(parent: _controller, curve: Curves.easeIn),
    );

    _scaleAnimation = Tween<double>(begin: 0.0, end: 1.0).animate(
      CurvedAnimation(
        parent: _controller,
        curve: Curves.elasticOut,
      ),
    );

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
    if (!_isInitialized || !_controller.isCompleted && !_controller.isAnimating) {
      return const SizedBox.shrink();
    }

    return FadeTransition(
      opacity: _fadeAnimation,
      child: ScaleTransition(
        scale: _scaleAnimation,
        child: child,
      ),
    );
  }


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: Stack(
          alignment: Alignment.center,
          children: [
            // Logo di atas
            Positioned(
              top: 50,
              child: Image.asset(
                'assets/logo.jpeg',
                height: 170,
              ),

            ),

            // Tombol utama
            Positioned(
              top: 300,
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
                        'HOLD TO\nREPORT',
                        textAlign: TextAlign.center,
                        style: TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                          letterSpacing: 1,
                          fontSize: 18.88,
                        ),
                      )
                    ],
                  ),
                ),
              ),
            ),

            // show the widget if it was true
            if (showWidgets)
              Positioned(
                top: 300,
                child: SizedBox(
                  width: MediaQuery.of(context).size.width,
                  height: 350,
                  child: Stack(
                    clipBehavior: Clip.none,
                    children: [
                      // Tengah
                      Positioned(
                        top: -80  ,
                        left: MediaQuery.of(context).size.width / 2 - 33,
                        child: _buildAnimatedWidget(
                          ReportCategoryWidget(
                            title: "Kebakaran",
                            icon: Icons.local_fire_department,
                            color: Colors.red,
                            onTap: () => print("Kebakaran dipilih"),
                          ),
                        ),
                      ),
                      // Kiri atas
                      Positioned(
                        top: -30,
                        left: MediaQuery.of(context).size.width / 2 - 160,
                        child:  _buildAnimatedWidget(
                            ReportCategoryWidget(
                              title: "Kecelakaan",
                              icon: Icons.car_crash,
                              color: Colors.blue,
                              onTap: () => print("Kecelakaan dipilih"),
                            )
                        ),
                      ),
                      // Kanan atas
                      Positioned(
                        top: -30,
                        right: MediaQuery.of(context).size.width / 2 - 155,
                        child:  _buildAnimatedWidget(
                            ReportCategoryWidget(
                            title: "Kejahatan",
                            icon: Icons.security,
                            color: Colors.black,
                            onTap: () => print("Kriminal dipilih"),
                          )
                        ),
                      ),
                      // Kiri bawah
                      Positioned(
                        top: 230,
                        left: MediaQuery.of(context).size.width / 2 - 130,
                        child:  _buildAnimatedWidget(
                          ReportCategoryWidget(
                          title: "Bencana",
                          icon: Icons.warning,
                          color: Colors.deepPurple,
                          onTap: () => print("Bencana dipilih"),
                          )
                        ),
                      ),
                      // Kanan bawah
                      Positioned(
                        top: 230,
                        right: MediaQuery.of(context).size.width / 2 - 130,
                        child:  _buildAnimatedWidget(ReportCategoryWidget(
                          title: "Lainnya",
                          icon: Icons.help,
                          color: Colors.teal,
                          onTap: () => print("Lainnya dipilih"),
                          )
                        ),
                      ),
                    ],
                  ),
                ),
              ),
          ],

        ),
      ),

    );
  }
}
