import 'package:flutter/material.dart';

class StateWidget extends StatelessWidget {
  final String label;
  final IconData icon;
  final Color color;

  const StateWidget({
    super.key,
    required this.label,
    required this.icon,
    required this.color,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        Container(
          alignment: Alignment.center,
          padding: const EdgeInsets.all(12),
          decoration: BoxDecoration(
            shape: BoxShape.circle,
            border: Border.all(color: color, width: 3),
          ),
          child: Icon(icon, color: color, size: 36),
        ),
        const SizedBox(height: 8),
        Text(
          label,
          style: const TextStyle(color: Colors.black),
          textAlign: TextAlign.center,
        ),
      ],
    );
  }
}
