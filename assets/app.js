import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import noUiSlider from 'nouislider'
import 'nouislider/distribute/nouislider.css'
const slider = document.getElementById('price-slider');

if (slider) {
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');

    const minValue = Math.floor(parseInt(slider.dataset.min, 10)  / 10) * 10;
    const maxValue = Math.ceil(parseInt(slider.dataset.max, 10) / 10) * 10;

    const range = noUiSlider.create(slider, {
        start: [minPrice.value || minValue, maxPrice.value || maxValue],
        connect: true,
        step: 10,
        range: {
            'min': minValue,
            'max': maxValue
        }
    });

    range.on('slide', function (values, handle) {
        if (handle === 0) {
            minPrice.value = Math.round(values[0])
        }

        if (handle === 1) {
            maxPrice.value = Math.round(values[1])
        }
    })
}