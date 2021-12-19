/**
 * Import vendor modules
 */

/**
 * Import additional modules here:
 *
 * import './module_xyz';
 */
import MainNav from './MainNav';
import HeroSlider from './HeroSlider';
import Accordion from './Accordion';
import DropDown from './Dropdown';
import BackToTop from "./BackToTop";
import SmoothScroll from "./SmoothScroll";

/**
 * Main App module used in index.js to initialise all other modules, includes helper functions/modules for use in initialising
 * modules depending on various criteria
 *
 * @returns {{init: init}}
 */
export default (() => {
	/**
	 * @param Module {Object}
	 * @param Module.init {Function}
	 * @param name {string|boolean}
	 * @param options {Object}
	 */
	const alwaysInit = ( Module, name = false, options = false ) => {
		if ( name ) {
			loadedModules[ name ] = Module
		}
		Module.init( options )
	}

	const initialiseIfPartialInPage = ( partial, Module ) => {
		if ( window.partialsUsed.includes( partial ) ) {
			Module.init()
		}
	}

	/**
	 * @param Module {Object}
	 * @param Module.init {Function}
	 * @param name {string|boolean}
	 * @param options {Object}
	 *
	 * Detects preferred reduce motion before initiating the module
	 */
	const initialiseIfAnimationAllowed = (
		Module,
		name = false,
		options = false
	) => {
		if ( !window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
			Module.init( options )
			if ( name ) {
				loadedModules[ name ] = Module
			}
		}
	}

	/**
	 * @param Module {Object}
	 * @param Module.init {Function}
	 * @param name {string|boolean}
	 * @param CB {Function|Boolean}
	 * @param options {Object}
	 */
	const initialiseOnHomepage = (
		Module,
		name = false,
		CB = false,
		options = false
	) => {
		if ( window.isHomePage ) {
			Module.init( options )
			if ( name ) {
				loadedModules[ name ] = Module
			}
			if ( CB !== false ) CB( true )
		} else if ( CB !== false ) {
			CB( false )
		}
	}

	/**
	 * @param breakpoints {Array}
	 *    [
	 *      100, // MIN BREAKPOINT Or false if no min
	 *      800 // MAX BREAKPOINT Or false if no max
	 *    ]
	 *
	 * @param Module {Object}
	 * @param Module.init {Function} - initialises the module
	 *
	 * Detects media query is reached before initiating the module, uses resize event listener to initialise the module
	 * when this breakpoint is reached
	 */
	const initialiseInBreakpoint = ( breakpoints, Module ) => {
		const media = Media.getMedia( breakpoints )
		if ( !media ) return false

		if ( media.matches ) {
			Module.init()
		} else {
			const initOnResize = () => {
				if ( media.matches ) {
					Module.init()
					window.removeEventListener( 'resize', initOnResize )
				}
			}

			window.addEventListener( 'resize', initOnResize )
		}

		return true
	}

	const init = () => {
		/**
		 * Initialise other modules here, check for prefer reduced motion for animations, etc
		 **
		 * Only initialise a module when screen width criteria is met:
		 * Module name is: IntersectionLazyLoad
		 * initialiseInBreakpoint([200, 700], IntersectionLazyLoad); // Between 200px and 700px
		 * initialiseInBreakpoint([768, false], IntersectionLazyLoad); // Greater than 768px
		 * initialiseInBreakpoint([false, 967], IntersectionLazyLoad); // Less than 967px
		 **
		 * Only initialise a module if prefers reduced motion isn't set (user hasn't requested no animation)
		 * Module name is: AnimateElements
		 * initialiseIfAnimationAllowed(AnimateElements);
		 */

		// focusWithin(document, { force: true });
		alwaysInit( MainNav )
		alwaysInit( HeroSlider )
		alwaysInit( DropDown )
		alwaysInit( BackToTop )
		Accordion.init(
			{
				accordionClass: "accordion__panel",
				accordionTrigger: "accordion__panel__trigger",
				speed: "200",
			}
		);
		SmoothScroll.init({
			startingClass: "smooth-scroll", // Accepts any string
			offsetTarget: -50, // Accepts - and + numbers:  Offset from target px
			easingOption: "easeInOutCubic", // linear , easeInOutQuad , easeInOutCubic
			duration: 1000,
		});
	}

	return {
		init,
	}
})()
