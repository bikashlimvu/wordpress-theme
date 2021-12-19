/** Internal helper imports here ... */
import theme from "../../theme.json";

/**
 * Module description...
 *
 * @returns {{init: init}}
 */
const breakpoint = (() => {
  const breakpoints = Object.keys(theme['grid-breakpoints']);

  const getBreakpoint = () => {
    return window.getComputedStyle(document.body, ':before').content.replace(/\"/g, '');
  }

  const isBreakpointDown = (targetBreakpoint) => {
    const currentBreakpoint = getBreakpoint();
    return breakpoints.indexOf(currentBreakpoint) <= breakpoints.indexOf(targetBreakpoint);
  }

  const isBreakpointUp = (targetBreakpoint) => {
    const currentBreakpoint = getBreakpoint();
    return breakpoints.indexOf(currentBreakpoint) >= breakpoints.indexOf(targetBreakpoint);
  }

  return {
    getBreakpoint,
    isBreakpointDown,
    isBreakpointUp
  };
})();

export default breakpoint;

