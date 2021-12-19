const Slider = (() => {
	const DOM = {}
	const slideIndexCounter = {};

	let options

	const cacheDOM = () => {
		const { containerClass } = options
		DOM.container = document.getElementsByClassName(`${containerClass}`)
	}

	const getSliderElements = ( sliderContainer ) => {
		const { sliderClass, dotsClass } = options
		const slider = sliderContainer.getElementsByClassName(`${sliderClass}`)
		const slides = Array.from(slider[0].children)
		const dots = sliderContainer.nextElementSibling.getElementsByClassName(`${dotsClass}`)
		// const slideWidth = slides[0].getBoundingClientRect().width
		const slideWidth = slides[0].offsetWidth
		const slidesLength = slides.length

		return {
			slider,
			slides,
			dots,
			slideWidth,
			slidesLength
		}
	}

	const setSlidePosition = (slide, slideIndex, slideWidth) => {
		slide.style.left = slideWidth * slideIndex + 'px'
	}

	const setFirstSlide = (slider, slides, dots) => {
		slider[0].style.transform =
			'translateX(-' + slides[0].style.left + ')'
		setClass(0, slides, dots)
	}

	const shiftSlide = (dir, action, slider, slides, slideWidth, dots, sliderIndex) => {
		slider[0].classList.add('shifting')
		if (slideIndexCounter[sliderIndex].allowShift) {
			if (!action) {
				slideIndexCounter[sliderIndex].posInitial = slides[slideIndexCounter[sliderIndex].index].offsetLeft
			}

			if (dir === 1) {
				slider[0].style.transform =
					'translateX(-' + (slideIndexCounter[sliderIndex].posInitial + slideWidth) + 'px)'
				slideIndexCounter[sliderIndex].index++
			} else if (dir === -1) {
				slider[0].style.transform =
					'translateX(-' + (slideIndexCounter[sliderIndex].posInitial - slideWidth) + 'px)'
				slideIndexCounter[sliderIndex].index--
			}
		}

		setClass(slideIndexCounter[sliderIndex].index, slides, dots)
		slideIndexCounter[sliderIndex].allowShift = false
	}

	const moveToSlide = (targetSlide, slider, slideWidth, sliderIndex) => {
		slider[0].classList.add('shifting')

		// setClass(parseInt(targetSlide.dataset.value))

		let slide = parseInt(targetSlide.dataset.value) + 1

		if (slide === 1) {
			slider[0].style.transform = 'translateX(-' + slideWidth + 'px)'
		}
		else if (slide > 1) {
			slider[0].style.transform =
				'translateX(-' + slideWidth * slide + 'px)'
		}

		slideIndexCounter[sliderIndex].index = slide - 1
		slideIndexCounter[sliderIndex].allowShift = false
	}

	const cloneSlide = (slider, slides, slidesLength) => {
		let firstSlide = slides[0]
		let lastSlide = slides[slidesLength - 1]

		let cloneFirst = firstSlide.cloneNode(true)
		let cloneLast = lastSlide.cloneNode(true)

		slider[0].appendChild(cloneFirst)
		slider[0].insertBefore(cloneLast, firstSlide)
	}

	const setClass = (targetSlide, slides, dots) => {
		if (targetSlide === slides.length) {
			targetSlide = 0
		}

		for (let i = 0; i < slides.length; i++) {
			slides[i].classList.remove('current-slide')
			dots[i].classList.remove('current-slide')
		}

		if (targetSlide >= 0) {
			slides[targetSlide].classList.add('current-slide')
			dots[targetSlide].classList.add('current-slide')
		}
	}

	const setupSlider = () => {
		Array.from(DOM.container).forEach( (sliderContainer, sliderIndex) => {
			const sliderElements = getSliderElements(sliderContainer);
			const { slider, slides, slideWidth, slidesLength, dots} = sliderElements
			slideIndexCounter[sliderIndex] = {
				posInitial: undefined,
				index: 0,
				allowShift: true
			}

			cloneSlide(slider, slides, slidesLength)

			const newSlides = Array.from(slider[0].children)
			newSlides.forEach( (slide, slideIndex) => {
				setSlidePosition(slide, slideIndex, slideWidth)
			})

			setFirstSlide(slider, slides, dots)

			setInterval(() => {
				shiftSlide(1, false, slider, slides, slideWidth, dots, sliderIndex)
			}, 6000)


			setupEventListeners(sliderIndex, slider, slides, slideWidth, slidesLength, dots)
		});
	}

	const checkIndex = (slider, slideWidth, slidesLength, sliderIndex) => {
		slider[0].classList.remove('shifting')

		if (slideIndexCounter[sliderIndex].index === -1) {
			slider[0].style.transform = 'translateX(-' + slideWidth *
				slidesLength + 'px)'

			slideIndexCounter[sliderIndex].index = slidesLength - 1
		}

		if (slideIndexCounter[sliderIndex].index === slidesLength) {
			slider[0].style.transform = 'translateX(-' + 1 * slideWidth + 'px)'

			slideIndexCounter[sliderIndex].index = 0
		}
		slideIndexCounter[sliderIndex].allowShift = true
	}

	const setupEventListeners = ( sliderIndex, slider, slides, slideWidth, slidesLength, dots ) => {
		slides[0].classList.add('current-slide')
		dots[0].classList.add('current-slide')

		window.addEventListener('resize', () => {
			// slideWidth = slides[0].getBoundingClientRect().width

			const newSlides = Array.from(slider[0].children)
			newSlides.forEach(setSlidePosition)
			moveToSlide(dots[slideIndexCounter[sliderIndex].index], slider, slideWidth, sliderIndex)
		})

		for (let i = 0; i < dots.length; i++) {
			dots[i].addEventListener('click', (e) => {
				e.stopPropagation()
				e.preventDefault()
				moveToSlide(e.target, slider, slideWidth, sliderIndex)
				setClass(slideIndexCounter[sliderIndex].index, slides, dots)
			})
		}
		slider[0].addEventListener('transitionend', function() {
			checkIndex(slider, slideWidth, slidesLength, sliderIndex);
		})
	}

	function init ( customOptions ) {

		const defaults = {
			containerClass: 'js-slider',
			sliderClass: 'js-slider--track',
			nextClass: 'hero-image__next',
			prevClass: 'hero-image__prev',
			dotsClass: 'js-slider--dot',
		}

		options = Object.assign(defaults, customOptions)

		cacheDOM()

		if (DOM.container.length > 0) {
			setupSlider()
		}
	}

	return { init }
})()
export default Slider
