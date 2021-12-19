const Accordion = (() => {
    const DOM = {};
    let options;

    const cacheDOM = () => {
        const { accordionClass, accordionTrigger } = options;
        DOM.Accordion = document.getElementsByClassName(`${accordionClass}`);
        DOM.triggers = document.getElementsByClassName(`${accordionTrigger}`);
    };

    /**
     * @param element {Element}
     */
    const closeAccordion = (element) => {
        const { activeClass, speed, easingOption, duration } = options;

        let buttons = element.lastElementChild.getElementsByTagName("button");
        let links = element.lastElementChild.getElementsByTagName("a");

        element.classList.remove(activeClass);

        const panel = element.lastElementChild;
        let panelHeight = getComputedStyle(panel).height;
        panelHeight = panelHeight.substr(0, panelHeight.length - 2);

        const keyframeDuration = duration ? duration : (panelHeight / 100) * speed;

        panel.setAttribute(
            "style",
            `
      overflow: hidden;
      transition: height ${keyframeDuration}ms ${easingOption};
      height: 0;
      `
        );

        for (let i = 0; i < buttons.length; i += 1) {
            buttons[i].setAttribute("tabindex", "-1");
        }

        for (let i = 0; i < links.length; i += 1) {
            links[i].setAttribute("tabindex", "-1");
        }
    };

    const openAccordion = (element) => {
        const { activeClass, speed, easingOption, duration } = options;

        let buttons = element.lastElementChild.getElementsByTagName("button");
        let links = element.lastElementChild.getElementsByTagName("a");

        element.classList.add(activeClass);

        const panel = element.lastElementChild;
        let panelHeight = panel.scrollHeight;
        const keyframeDuration = duration ? duration : (panelHeight / 100) * speed;

        panel.setAttribute(
            "style",
            `
      overflow: hidden;
      transition: height ${keyframeDuration}ms ${easingOption};
      height: ${panelHeight}px;
      `
        );

        for (let i = 0; i < buttons.length; i += 1) {
            buttons[i].setAttribute("tabindex", "0");
        }

        for (let i = 0; i < links.length; i += 1) {
            links[i].setAttribute("tabindex", "0");
        }
    };

    const onClick = (event) => {
        const { accordionClass, activeClass } = options;
        const targetClass = event.classList;

        let closeTarget = DOM.Accordion;
        let closeClass = accordionClass;

        if (targetClass.contains(`${activeClass}`)) {
            closeAccordion(event);
        } else {
            if (targetClass.contains(`${accordionClass}`)) {
                for (let i = 0; i < closeTarget.length; i += 1) {
                    const classList = Array.from(closeTarget[i].classList);
                    if (classList.indexOf(activeClass) !== -1) {
                        closeAccordion(closeTarget[i]);
                    }
                }
            }
            openAccordion(event);
        }
    };

    const handleClick = (target) => {
        target.stopPropagation();
        target.preventDefault();

        onClick(target.currentTarget);
    };

    const keyDown = (event) => {
        const { accordionTrigger } = options;
        let target = event.target;
        let key = event.which.toString();
        let ctrlModifier = event.ctrlKey && key.match(/33|34/);

        if (target.classList.contains(`${accordionTrigger}`)) {
            //   // Up/ Down arrow and Control + Page Up/ Page Down keyboard operations
            //   // 38 = Up, 40 = Down
            if (key.match(/38|40/) || ctrlModifier) {
                let index = Array.prototype.slice.call(DOM.triggers).indexOf(target);
                let direction = key.match(/34|40/) ? 1 : -1;
                let length = DOM.triggers.length;
                let newIndex = (index + length + direction) % length;
                DOM.triggers[newIndex].focus();

                event.preventDefault();
            } else if (key.match(/13|32|35|36/)) {
                // 35 = End, 36 = Home keyboard operations
                switch (key) {
                    // Go to first accordion
                    case "36":
                        DOM.triggers[0].focus();
                        break;
                    // Go to last accordion
                    case "35":
                        DOM.triggers[DOM.triggers.length - 1].focus();
                        break;
                    // Toggle accordion when either "Enter" or "Spacebar" is used
                    case "13":
                    case "32":
                        onClick(event.currentTarget);
                        break;
                }
                event.preventDefault();
            }
        }
    };

    const setupEventListeners = () => {
        for (let i = 0; i < DOM.Accordion.length; i += 1) {
            DOM.Accordion[i].addEventListener("click", handleClick);
            DOM.Accordion[i].addEventListener("keydown", keyDown);
        }
    };

    const noJS = () => {
        for (let i = 0; i < DOM.Accordion.length; i += 1) {
            closeAccordion(DOM.Accordion[i]);
        }
    };

    const init = (customOptions) => {
        const defaults = {
            accordionClass: "accordion", // Accepts any string
            accordionTrigger: "accordion-trigger",
            activeClass: "active", // Accepts any string
            easingOption: "ease-in-out", // Accepts string https://developer.mozilla.org/en-US/docs/Web/API/EffectTiming/easing,
            duration: false, // {boolean/number}
            speed: 500, // Number - Speed of the animation in ms
        };

        options = Object.assign(defaults, customOptions);

        cacheDOM();
        setupEventListeners();
        noJS();
    };

    return { init };
})();

export default Accordion;
