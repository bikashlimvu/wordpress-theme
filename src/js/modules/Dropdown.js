const DropDown = (() => {
	const DOM  = {};

	const cacheDOM       = () => {
		DOM.Select       = document.querySelectorAll( ".dropdown" );
		DOM.buttonSelect = document.getElementsByClassName(
			"dropdown__button"
		);
	};

	const wrapElement   = (el, wrapper, i) => {
		const wrapperEl = wrapper;

		el.parentNode.insertBefore( wrapperEl, el );
		wrapperEl.appendChild( el );

		DOM.coverElement  = document.createElement( "div" );
		DOM.buttonElement = document.createElement( "a" );
		DOM.spanElement   = document.createElement( "span" );
		DOM.ulElement     = document.createElement( "ul" );

		wrapperEl.className         = `dropdown dropdown--${i}`;
		DOM.buttonElement.className = `dropdown__button`;
		DOM.buttonElement.setAttribute(
			"data-value",
			el.options[0].getAttribute( "value" )
		);
		DOM.buttonElement.setAttribute( "tabindex", "0" );
		DOM.ulElement.className    = `dropdown__list dropdown__list--${i}`;
		DOM.coverElement.className = `dropdown__cover dropdown__cover--${i}`;

		wrapperEl.parentNode.prepend( DOM.coverElement );
		wrapperEl.appendChild( DOM.buttonElement );
		DOM.buttonElement.appendChild( DOM.spanElement );
		wrapperEl.appendChild( DOM.ulElement );

		DOM.span = el.options[0].text;

		const spanText = document.createTextNode( DOM.span );
		DOM.spanElement.appendChild( spanText );
	};

	const openDropdown     = (event, activeSelectEl) => {
		const element      = event.currentTarget;
		const coverElement = activeSelectEl.parentNode.parentNode.firstChild;

		if (element.tagName === "A") {
			DOM.selectDropdown = element.parentNode.getElementsByTagName( "ul" );
			coverElement.classList.add( "active" ); // Toggle Cover background

			for (let i = 0, len = DOM.selectDropdown.length; i < len; i += 1) {
				DOM.selectDropdown[0].classList.toggle( "active" );
				DOM.selectDropdown[0].parentNode.classList.toggle(
					"active"
				);
			}
		} else if (element.tagName === "LI") {
			DOM.elementParentSpan = element.parentNode.parentNode.getElementsByTagName(
				"span"
			);
			coverElement.classList.remove( "active" ); // Toggle Cover background
			element.parentNode.classList.toggle( "active" ); // Toggle active class on ul element
			document.querySelectorAll( ".dropdown__list-item" ).forEach( el => el.classList.remove( "active" ) ); // Remove active class on all elements
			element.classList.add( "active" ); // Add active class on selected element
			activeSelectEl.parentNode.classList.toggle( "active" ); // Toggle active class on active select element(i.e. dropdown)
			DOM.elementParentSpan[0].textContent = element.textContent;
			DOM.elementParentSpan[0].parentNode.setAttribute(
				"data-value",
				element.getAttribute( "data-value" )
			);
		}
	};

	const closeCover       = selectButton => {
		const coverElement = selectButton.parentNode.parentNode.querySelector( ".dropdown__cover" );
		DOM.List           = document.getElementsByClassName(
			"dropdown__list"
		);

	for (let i = 0; i < DOM.List.length; i += 1) {
		if (DOM.List[i].classList.contains( "active" )) {
			DOM.List[i].classList.remove( "active" );
			DOM.List[i].parentElement.parentElement.classList.remove( "active" );
		}
	}

		coverElement.classList.remove( "active" );
	};

	const createDiv = () => {
		for (let si = 0; si < DOM.Select.length; si += 1) {
			// DOM.Select[si].style.display = "none"; // Display none on select > option
			wrapElement(
				DOM.Select[si],
				document.createElement( "div" ),
				si
			);

			for (let i = 0; i < DOM.Select[si].options.length; i += 1) {
				DOM.liElement           = document.createElement( "li" );
				DOM.optionValue         = DOM.Select[si].options[i].value;
				DOM.optionText          = document.createTextNode(
					DOM.Select[si].options[i].text
				);
				DOM.liElement.className = "dropdown__list-item";
				DOM.liElement.setAttribute( "data-value", DOM.optionValue );
				DOM.liElement.setAttribute( "tabindex", "0" );
				DOM.liElement.setAttribute(
					"data-type",
					DOM.Select[si].options[i].getAttribute( "data-type" )
				);
				DOM.liElement.appendChild( DOM.optionText );
				DOM.ulElement.appendChild( DOM.liElement );

				DOM.liElement.addEventListener(
					"click",
					event => {
                    openDropdown( event, DOM.Select[si] );
					},
					false
				);

				DOM.liElement.addEventListener(
					"keypress",
					event => {
						const key = event.which || event.keyCode;
						if (key === 13) {
							openDropdown( event, DOM.Select[si] );
						}
					}
				);
			}
		}
	};

	const isMobileDevice = () => (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ));

	const handleNoSelectionEvent    = selectButton => {
		document.addEventListener(
			"click",
			(evt) => {
				const dropdownContainer = DOM.selectDropdown[0].parentNode;
				const targetElement = evt.target;

				if (targetElement !== dropdownContainer) {
					closeCover( selectButton );
					dropdownContainer.classList.remove( "active" );
				}
			}
		);
	}

	const updateMobileSelectButton            = (dropdownSelectionButton, selectElement) => {
		selectElement.addEventListener(
			"change",
			event => {
				const selectedDropdownOption      = selectElement.options[selectElement.selectedIndex].text;
				const selectedDropdownOptionValue = selectElement.options[selectElement.selectedIndex].getAttribute( "value" );
				const dropdownButton              = dropdownSelectionButton.firstChild;
				dropdownButton.innerText          = selectedDropdownOption;
				dropdownSelectionButton.setAttribute(
					"data-value",
                selectedDropdownOptionValue
				);
			}
		);
	}

	const displayMobileSelect = (dropdownSelectionButton, selectElement) => {
		selectElement.classList.add( 'is-active' );
		updateMobileSelectButton( dropdownSelectionButton, selectElement );
	}

	const eventListener = () => {
		for (let i = 0; i < DOM.buttonSelect.length; i += 1) {
			if (isMobileDevice()) {
				displayMobileSelect( DOM.buttonSelect[i], DOM.Select[i] );
			}

			DOM.buttonSelect[i].addEventListener(
				"click",
				event => {
					event.stopPropagation();
					event.preventDefault();
					openDropdown( event, DOM.Select[i] );
					handleNoSelectionEvent( event.currentTarget );
				}
			);

			DOM.buttonSelect[i].addEventListener(
				"keypress",
				event => {
					const key = event.which || event.keyCode;
					if (key === 13) {
						openDropdown( event, DOM.Select[i] );
					}
				}
			);
		}
	};

	const init = () => {
		// code to initialise the module
		cacheDOM();
		createDiv();
		eventListener();
	};

	return {
		init
	};
})();

export default DropDown;
