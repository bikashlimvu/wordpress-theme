import Breakpoint from '../helpers/breakpoint'

/**
 * Module description...
 *
 * @returns {{init: init}}
 */
const MainNav = (() => {
  const DOM = {};
  const transitionBreakpoint = 'md';
  let menuHeight;
  let initialMenuHeight;

  const cacheDOM = () => {
    DOM.body = document.getElementsByTagName('body')
    DOM.hamburger = document.getElementsByClassName('toggleNav')
    DOM.toggleNav = document.getElementsByClassName('nav')
    DOM.menuContainer = document.getElementsByClassName('menu-main-menu-container')
    DOM.menuWrapper = document.getElementById('menu-main-menu')
    DOM.subMenuToggles = document.querySelectorAll(
      '#menu-main-menu li.menu-item-has-children > a'
    )
    menuHeight = DOM.toggleNav[0].scrollHeight;
    initialMenuHeight = DOM.toggleNav[0].scrollHeight;
  }

  const toggleNav = () => {
    const menu = DOM.toggleNav[0]
    const hamburger = DOM.hamburger[0]

    if (!hamburger.classList.contains('open')) {
      DOM.body[0].classList.add('isFixed');
      hamburger.classList.add('open')
      menu.style.height = initialMenuHeight + "px";
    } else {
      DOM.body[0].classList.remove('isFixed');
      hamburger.classList.remove('open')
      menu.style.height = 0;
      DOM.menuContainer[0].style.height = initialMenuHeight + "px";

      DOM.subMenuToggles.forEach((item) => {
        if (item.nextElementSibling.classList.contains('open')) {
          item.nextElementSibling.classList.remove('open')
          item.nextElementSibling.style.height = 0;
        }
      })
    }
  }

  const activatePanelScrolling = () => {
    if ( DOM.menuContainer[0].scrollHeight > DOM.toggleNav[0].scrollHeight ) {
      DOM.menuWrapper.style.height = DOM.toggleNav[0].scrollHeight + "px";
    } else {
      DOM.menuWrapper.style.height = "100%";
    }
  }

  const calculateSubmenuParentMenuHeight = ( elementTotalHeight, activeMenuItem ) => {
    const parentMenuWrapper = activeMenuItem.parentNode.parentNode;
    const currentParentMenuHeight = parseInt(parentMenuWrapper.style.height.replace( "px", "" ));
    if ( parentMenuWrapper.classList.contains( 'open' ) && !activeMenuItem.nextElementSibling.classList.contains( 'open' ) ) {
      parentMenuWrapper.style.height = ( currentParentMenuHeight + elementTotalHeight ) + "px";
    } else if ( parentMenuWrapper.classList.contains( 'open' ) && activeMenuItem.nextElementSibling.classList.contains( 'open' ) ) {
      parentMenuWrapper.style.height = ( currentParentMenuHeight - elementTotalHeight ) + "px";
    }
  }

  const displaySubMenu = ( submenuElement, elementTotalHeight ) => {
    if ( submenuElement.classList.contains('open') ) {
      submenuElement.style.height = 0 + "px";
    } else {
      submenuElement.style.height = elementTotalHeight + "px";
    }
  }

  const calculatePanelHeight = ( submenuElement, elementTotalHeight ) => {
    let newHeight;
    if ( submenuElement.classList.contains('open') ) {
      newHeight = menuHeight - elementTotalHeight;
    } else {
      newHeight = menuHeight + elementTotalHeight;
    }
    return newHeight;
  }

  // If submenu is open and the user has not clicked on the dropdown icon
  // then allow the user to be able to click through to the parent menu item link
  const openMenuLink = (event) => {
    const triggeredElement = event.target;
    const clickedMenuItem = event.currentTarget;
    const dropdownIcon = triggeredElement.classList.contains("dropdown-icon");
    const submenuOpen = clickedMenuItem.nextElementSibling.classList.contains("open");

    return !dropdownIcon && submenuOpen;
  }

  const openSubMenu = (event) => {
    const openParentMenuLink = openMenuLink(event);

    if (openParentMenuLink === false ) {
      event.preventDefault();

      menuHeight = DOM.menuContainer[0].scrollHeight;

      const activeMenuItem = event.currentTarget;
      const submenuElement = event.currentTarget.nextElementSibling;

      let elementTotalHeight = 0;
      Array.from(event.currentTarget.nextElementSibling.children).forEach(menu => {
        elementTotalHeight += menu.offsetHeight;
      })

      calculateSubmenuParentMenuHeight(elementTotalHeight, activeMenuItem)
      displaySubMenu(submenuElement, elementTotalHeight)
      const newHeight = calculatePanelHeight(submenuElement, elementTotalHeight)

      event.currentTarget.nextElementSibling.classList.toggle('open')
      DOM.toggleNav[0].style.height = "calc( 100% - 160px)";
      DOM.menuContainer[0].style.height = newHeight + "px";
      activatePanelScrolling();

      return false;
    }
  }

  const closeSubMenu = (event) => {
    event.currentTarget.parentElement.classList.toggle('open')
  }

  const eventListeners = () => {
    let addMobileNavEventListeners = () => {
      DOM.hamburger[0].addEventListener('click', toggleNav)
      Array.from(DOM.subMenuToggles).forEach((HTMLNode) => {
        HTMLNode.addEventListener('click', openSubMenu)
      })
    }

    if (Breakpoint.isBreakpointDown(transitionBreakpoint)) {
      addMobileNavEventListeners()
    }

    window.addEventListener('resize', function () {
      if (Breakpoint.isBreakpointDown(transitionBreakpoint)) {
        addMobileNavEventListeners()
      } else {
        DOM.hamburger[0].removeEventListener('click', toggleNav)
        Array.from(DOM.subMenuToggles).forEach((HTMLNode) => {
          HTMLNode.removeEventListener('click', openSubMenu)
        })
      }
    }, false)
  }

  const init = () => {
    cacheDOM()
    eventListeners()
  }

  return {
    init,
  }
})()

export default MainNav
