import easingFunctions from "../helpers/easingFunction";

const SmoothScroll = (() => {
    let Links;
    let Options;

    /* =========== private methods =========== */

    function cacheDOM() {
        const { startingClass } = Options;
        Links = document.querySelectorAll(`.${startingClass}`);
    }

    function onClick(event) {
        const { offsetTarget, easingOption, duration } = Options;
        event.preventDefault();

        const targetId = event.currentTarget.getAttribute("href");
        const targetPosition =
            document.querySelector(targetId).offsetTop + offsetTarget; //
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition;

        let start = null;

        function step(timestamp) {
            if (!start) start = timestamp;
            const progress = timestamp - start;
            const easing = easingFunctions[easingOption];

            window.scrollTo(0, easing(progress, startPosition, distance, duration));
            if (progress < duration) window.requestAnimationFrame(step);
        }

        window.requestAnimationFrame(step);
    }

    function setupEventListeners() {
        for (let i = 0; i < Links.length; i += 1) {
            Links[i].addEventListener("click", (event) => {
                event.stopPropagation();
                event.preventDefault();
                onClick(event);
            });
        }
    }

    /* =========== public methods =========== */

    function init(customOptions) {
        const defaults = {
            startingClass: "smooth-scroll", // Accepts any string
            offsetTarget: 0, // Accepts - and + numbers:  Offset from target px
            easingOption: "easeInOutCubic", // linear , easeInOutQuad , easeInOutCubic
            duration: 1000,
        };

        Options = Object.assign(defaults, customOptions);

        cacheDOM();
        setupEventListeners();
    }

    return { init };
})();

export default SmoothScroll;
