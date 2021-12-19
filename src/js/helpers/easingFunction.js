// Easing Functions

const easingFunctions = {
  // no easing, no acceleration
  linear: (t, b, c, d) => {
    return (c * t) / d + b;
  },
  easeInOutQuad: (t, b, c, d) => {
    t /= d / 2;
    if (t < 1) return (c / 2) * t * t + b;
    t -= 1;
    return (-c / 2) * (t * (t - 2) - 1) + b;
  },
  easeInOutCubic: (t, b, c, d) => {
    t /= d / 2;
    if (t < 1) return (c / 2) * t * t * t + b;
    t -= 2;
    return (c / 2) * (t * t * t + 2) + b;
  },
};
export default easingFunctions;
