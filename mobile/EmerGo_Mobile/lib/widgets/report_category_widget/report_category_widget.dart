import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class ReportCategoryWidget extends StatelessWidget {

  final String title;
  final IconData icon;
  final Color color;
  final VoidCallback onTap;

  const ReportCategoryWidget({
    super.key,
    required this.title,
    required this.icon,
    required this.color,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Column(
        children: [
          Container(
            padding: const EdgeInsets.all(12),
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              border: Border.all(color: color, width: 3)
            ),
            child: Icon(icon, color: color, size: 36,),
          ),
          const SizedBox(height: 8),
          Text(title,style: TextStyle(color: Colors.black),)
        ],
      ),
    );
  }
  
}